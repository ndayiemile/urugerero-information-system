window.onload = () => {
  let formData = new FormData();
  // get activities and intore counts
  server(
    getNumberOfActivitiesAndRegisteredIntore,
    "getNumberOfActivitiesAndRegisteredIntore",
    formData
  );
  // render graphs
  analyticsGraphs();
};
// render all graphs on the Dashboard UI
function analyticsGraphs() {
  //get the data attendance from server
  let formData = new FormData();
  formData.append("startDate", "2024-01-22");
  formData.append("endDate", "2024-01-26");
  server(prepareAttendanceData, "getCellAttendanceProgression", formData);
  server(prepareSectorDataOverView, "getSectorDataOverView", formData);
  server(
    prepareSectorAttendanceDataOverView,
    "getIntoreAttendanceClassificationByCell",
    formData
  );
  server(
    prepareSectorActivitiesDataOverView,
    "getSectorActivitiesDataOverView",
    formData
  );
  function prepareAttendanceData(response) {
    let showDataAsPercentages = false;
    let seriesData = [];
    let categoriesData = [];
    let getSeriesNames = (responseData) => {
      let unique_values = [
        ...new Set(responseData.map((element) => element.participant)),
      ];
      return unique_values;
    };
    let getAttendanceDays = (responseData) => {
      let unique_values = [
        ...new Set(responseData.map((element) => element.regDate)),
      ];
      return unique_values;
    };
    // console.log(response);
    categoriesData = getAttendanceDays(response.relationsData);
    let dataSet = getSeriesNames(response.relationsData);
    for (let i = 0; i < dataSet.length; i++) {
      let series = { name: dataSet[i], data: [] };
      response.relationsData.forEach((element) => {
        if (element.participant.toLowerCase() == dataSet[i].toLowerCase()) {
          //set the name
          let groupName = element.participant;
          series.name = groupName;
          //insert the values per cent
          let totalNumberOfGroupMembers = Number.parseInt(
            response.groupData.filter(
              (item) =>
                item.participant.toLowerCase() == groupName.toLowerCase()
            )[0].count
          );
          let attendedMembers = element.attendees;
          if (showDataAsPercentages) {
            let percentage = Math.round(
              (attendedMembers / totalNumberOfGroupMembers) * 100
            );
            series.data.push(percentage);
          } else {
            series.data.push(element.attendees);
          }
        }
      });
      seriesData.push(series);
    }
    renderChartForProjectedAttendanceRate(seriesData, categoriesData);
    function renderChartForProjectedAttendanceRate(seriesData, categoriesData) {
      // Cell Attendance Progression chart
      let options_chartForProjectedAttendanceRate = {
        series: seriesData,
        chart: {
          height: 350,
          type: "area",
          toolbar: {
            show: true,
            offsetX: 0,
            offsetY: 0,
            tools: {
              download: true,
              selection: true,
              zoom: true,
              zoomin: true,
              zoomout: true,
              pan: false,
              reset: true | '<img src="/static/icons/reset.png" width="20">',
              customIcons: [],
            },
            export: {
              csv: {
                filename: undefined,
                columnDelimiter: ",",
                headerCategory: "category",
                headerValue: "value",
                dateFormatter(timestamp) {
                  return new Date(timestamp).toDateString();
                },
              },
              svg: {
                filename: "Cell Attendance Progression",
              },
              png: {
                filename: "Cell Attendance Progression",
              },
            },
            autoSelected: "zoom",
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: "smooth",
        },
        xaxis: {
          type: "datetime",
          // tickAmount: 5,
          categories: categoriesData,
        },
        tooltip: {
          x: {
            format: "dd/MM",
          },
        },
      };
      let chart_chartForProjectedAttendanceRate = new ApexCharts(
        document.querySelector("#chartForProjectedAttendanceRate"),
        options_chartForProjectedAttendanceRate
      );
      chart_chartForProjectedAttendanceRate.render();
    }
  }
  function prepareSectorDataOverView(response) {
    let metricsBaseData = [];
    let seriesData = [];
    response.forEach((element) => {
      metricsBaseData.push(element.status);
      seriesData.push(Number.parseInt(element.counts));
    });
    renderSectorDataOverView(seriesData, metricsBaseData);
    function renderSectorDataOverView(seriesData, metricsBaseData) {
      let options_chartForSectorDataOverview = {
        series: seriesData,
        labels: metricsBaseData,
        chart: {
          type: "donut",
          height: 196,
        },
        responsive: [
          {
            breakpoint: 480,
            options: {
              chart: {
                width: 300,
              },
              legend: {
                position: "right",
              },
            },
          },
        ],
      };

      let chart_chartForSectorDataOverview = new ApexCharts(
        document.querySelector("#chartForSectorDataOverview"),
        options_chartForSectorDataOverview
      );
      chart_chartForSectorDataOverview.render();
    }
  }
  function prepareSectorAttendanceDataOverView(response) {
    let showDataAsPercentages = false;
    let seriesData = [];
    let getSeriesNames = (responseData) => {
      let unique_values = [
        ...new Set(
          responseData.map((element) => element.participant.toLowerCase())
        ),
      ];
      return unique_values;
    };
    let dataSet = getSeriesNames(response.relationsData);
    for (let i = 0; i < dataSet.length; i++) {
      let series = { name: dataSet[i], data: [0, 0, 0, 0] };
      response.relationsData.forEach((element) => {
        if (element.participant.toLowerCase() == series.name.toLowerCase()) {
          //set number of category members counter
          let attendedMembers = Number.parseInt(element.attendance);
          let totalNumberOfGroupActivities = Number.parseInt(
            response.groupData.filter(
              (item) =>
                item.participant.toLowerCase() == series.name.toLowerCase()
            )[0].numberOfActivities
          );
          let percentage = Math.round(
            (attendedMembers / totalNumberOfGroupActivities) * 100
          );
          if (percentage >= 75) {
            series.data[3] += 1;
          } else if (percentage >= 50) {
            series.data[2] += 1;
          } else if (percentage >= 25) {
            series.data[1] += 1;
          } else {
            series.data[0] += 1;
          }
        }
      });
      seriesData.push(series);
    }
    // sector data
    var sectorData = { name: "sector", data: [0, 0, 0, 0] };
    seriesData.forEach((item) => {
      for (let index = 0; index < 4; index++) {
        sectorData.data[index] += item.data[index];
      }
    });
    seriesData.push(sectorData);
    let metricsBaseData = ["0-25", "25-50", "50-75", "75-100"];
    renderSectorAttendanceDataOverView(seriesData, metricsBaseData);
    function renderSectorAttendanceDataOverView(seriesData, metricsBaseData) {
      let options_chartForSectorAttendanceDataOverView = {
        series: seriesData,
        chart: {
          type: "bar",
          height: 350,
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "55%",
            endingShape: "rounded",
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: true,
          width: 2,
          colors: ["transparent"],
        },
        xaxis: {
          categories: metricsBaseData,
        },
        yaxis: {
          title: {
            text: "Intore",
          },
        },
        fill: {
          opacity: 1,
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " Intores";
            },
          },
        },
      };

      let chart_chartForSectorAttendanceDataOverView = new ApexCharts(
        document.querySelector("#chartForSectorAttendanceDataOverView"),
        options_chartForSectorAttendanceDataOverView
      );
      chart_chartForSectorAttendanceDataOverView.render();
    }
  }

  function prepareSectorActivitiesDataOverView(response) {
    let seriesData = []
    let categoriesData = []
    response.forEach(item =>{
      seriesData.push(item.count)
      categoriesData.push(item.category)
    })
    renderSectorActivitiesDataOverView(seriesData, categoriesData);
    function renderSectorActivitiesDataOverView(seriesData, categoriesData) {
      let options_chartForSectorActivitiesDataOverView = {
        series: [
          {
            name: "",
            data: seriesData,
          },
        ],
        chart: {
          type: "bar",
          height: 350,
        },
        plotOptions: {
          bar: {
            borderRadius: 0,
            horizontal: true,
            distributed: true,
            barHeight: "80%",
            isFunnel: true,
          },
        },
        colors: ["#F44F5E", "#E55A89", "#D863B1", "#CA6CD8", "#B57BED"],
        dataLabels: {
          enabled: true,
          formatter: function (val, opt) {
            return opt.w.globals.labels[opt.dataPointIndex];
          },
          dropShadow: {
            enabled: true,
          },
        },
        xaxis: {
          categories: categoriesData,
        },
        legend: {
          show: false,
        },
      };
      let chart_chartForSectorActivitiesDataOverView = new ApexCharts(
        document.querySelector("#chartForSectorActivitiesDataOverView"),
        options_chartForSectorActivitiesDataOverView
      );
      chart_chartForSectorActivitiesDataOverView.render();
    }
  }
}
function getNumberOfActivitiesAndRegisteredIntore(response) {
  ObjectId("total-number-of-intore").innerText = response.intore;
  ObjectId("total-number-of-activities").innerText = response.activities;
}
