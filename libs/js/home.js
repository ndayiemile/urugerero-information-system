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
  //get done activities
  getDoneActivities();
};
// render all graphs on the Dashboard UI
function analyticsGraphs() {
  //get the data attendance from server
  let formData = new FormData();
  formData.append("startDate", "2024-01-01");
  formData.append("endDate", "2024-01-11");
  server(
    PrepareCellAttendanceProgression,
    "getCellAttendanceProgression",
    formData
  );
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
  function PrepareCellAttendanceProgression(response) {
    // console.log(response);
    let showDataAsPercentages = true;
    let seriesData = [];
    let categoriesData = [];
    let getAxisData = (responseData) => {
      let unique_values = {
        cellNames: [...new Set(responseData.map((element) => element.cell))],
        attendanceDays: [
          ...new Set(responseData.map((element) => element.dueDate)),
        ],
      };
      return unique_values;
    };
    let axisData = getAxisData(response.cellAttendees);
    categoriesData = axisData.attendanceDays;
    let dataSet = axisData.cellNames;
    for (let i = 0; i < dataSet.length; i++) {
      let series = { name: dataSet[i], data: [] };
      let membersInGroup = Number.parseInt(
        response.cellMembers.find((item) => item.cell == dataSet[i]).count
      );
      for (let j = 0; j < categoriesData.length; j++) {
        let attendance = (series.data[j] = response.cellAttendees.find(
          (item) => item.dueDate == categoriesData[j] && item.cell == dataSet[i]
        ));
        if (attendance != undefined) {
          attendance = Number.parseInt(attendance.attendees);
          if (showDataAsPercentages) {
            attendance = Math.round((attendance / membersInGroup) * 100);
          }
        } else {
          attendance = null;
        }
        series.data[j] = attendance;
      }
      seriesData.push(series);
    }
    // console.log(seriesData, categoriesData);
    renderChartForcellAttendanceProgression(seriesData, categoriesData);
    function renderChartForcellAttendanceProgression(
      seriesData,
      categoriesData
    ) {
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
              zoom: false,
              zoomin: true,
              zoomout: true,
              pan: false,
              reset: true | '<img src="/static/icons/reset.png" width="20">',
              customIcons: [
                {
                  icon: '<img src="../../libs/icons/211751_gear_icon.png" width="20">',
                  index: 4,
                  title: "set Graph Start and End Date",
                  class: "custom-icon",
                  click: function (chart, options, e) {
                    let dropDownPrototype = document.createElement("div");
                    dropDownPrototype.classList.add("settings-icon");
                    dropDownPrototype.innerHTML = `
                      <form class="apexcharts-menu-item" action="" method="post">
                      <p class="gs-fs-8 text-center">Analytics Period</p>
                      <input type="date" name="startDate" class="border rounded"/>
                      <input type="date" name="endDate" class="border rounded mt-1"/>
                      </form>
                    `;
                    let chartDiv = document.getElementById(
                      "chartForProjectedAttendanceRate"
                    );
                    // console.log(chartDiv);
                    let container = chartDiv.querySelector(
                      ".apexcharts-toolbar"
                    );
                    let dropDown = container.querySelector(".settings-icon");
                    if (!dropDown) {
                      dropDownPrototype.classList.add(
                        "apexcharts-menu",
                        "apexcharts-menu-open"
                      );
                      container.appendChild(dropDownPrototype);
                      dropDownPrototype.onmouseleave = () => {
                        dropDownPrototype.classList.remove(
                          "apexcharts-menu-open"
                        );
                      };
                    } else {
                      if (dropDown.classList.contains("apexcharts-menu-open")) {
                        dropDown.classList.remove("apexcharts-menu-open");
                      } else {
                        dropDown.classList.add("apexcharts-menu-open");
                      }
                    }
                    let form = dropDownPrototype.querySelector("form");
                    let endDateInput = form.querySelector(
                      "input[name=endDate]"
                    );
                    let startDateInput = form.querySelector(
                      "input[name=startDate]"
                    );
                    endDateInput.addEventListener("change", renderNewGraph);
                    startDateInput.addEventListener("change", renderNewGraph);
                    function renderNewGraph() {
                      if (
                        startDateInput.value != null &&
                        endDateInput.value != null &&
                        startDateInput.value < endDateInput.value
                      ) {
                        chartDiv.innerHTML = "";
                        let formData = new FormData();
                        formData.append("startDate", startDateInput.value);
                        formData.append("endDate", endDateInput.value);
                        server(
                          PrepareCellAttendanceProgression,
                          "getCellAttendanceProgression",
                          formData
                        );
                      }
                    }
                  },
                },
              ],
            },
            export: {
              csv: {
                filename: "Cell Attendance Progression",
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
    // console.log(response)
    let metricsBaseData = [];
    let seriesData = [];
    response.forEach((element) => {
      metricsBaseData.push(element.status);
      seriesData.push(Number.parseInt(element.categoryPercentage));
    });
    renderSectorDataOverView(seriesData, metricsBaseData);
    function renderSectorDataOverView(seriesData, metricsBaseData) {
      let options_chartForSectorDataOverview = {
        series: seriesData,
        labels: metricsBaseData,
        chart: {
          type: "donut",
          height: 196,
          toolbar: {
            show: true,
            offsetX: 0,
            offsetY: 0,
            tools: {
              download: true,
              selection: true,
              zoom: false,
              zoomin: true,
              zoomout: true,
              pan: false,
              reset: true | '<img src="/static/icons/reset.png" width="20">',
              customIcons: [],
            },
            export: {
              csv: {
                filename: "Intore Status",
                columnDelimiter: ",",
                headerCategory: "category",
                headerValue: "value",
                dateFormatter(timestamp) {
                  return new Date(timestamp).toDateString();
                },
              },
              svg: {
                filename: "Intore Status",
              },
              png: {
                filename: "Intore Status",
              },
            },
            autoSelected: "zoom",
          },
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
    console.log(response);
    let seriesData = [];
    let getSeriesNames = (responseData) => {
      let unique_values = [
        ...new Set(responseData.map((element) => element.cell.toLowerCase())),
      ];
      return unique_values;
    };
    let dataSet = getSeriesNames(response);
    for (let i = 0; i < dataSet.length; i++) {
      let series = { name: dataSet[i], data: [0, 0, 0, 0] };
      response.forEach((element) => {
        if (element.cell.toLowerCase() == series.name.toLowerCase()) {
          let category = element.category;
          let value = Number.parseInt(element.catCount);
          //set number of category members counter
          switch (category) {
            case "A":
              series.data[3] = value;
              break;
            case "B":
              series.data[2] = value;
              break;
            case "C":
              series.data[1] = value;
              break;

            default:
              series.data[0] = value;
              break;
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
    console.log(seriesData);
    let metricsBaseData = ["0-25%", "25-50%", "50-75%", "75-100%"];
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
        colors: [
          "#008FFB",
          "#00E396",
          "#FEB019",
          "#FF4560",
          "#3F51B5",
          "#4CAF50",
          "#F9CE1D",
          "#D4526E",
        ],
      };

      let chart_chartForSectorAttendanceDataOverView = new ApexCharts(
        document.querySelector("#chartForSectorAttendanceDataOverView"),
        options_chartForSectorAttendanceDataOverView
      );
      chart_chartForSectorAttendanceDataOverView.render();
    }
  }

  function prepareSectorActivitiesDataOverView(response) {
    let seriesData = [];
    let categoriesData = [];
    response.forEach((item) => {
      seriesData.push(item.count);
      categoriesData.push(item.category);
    });
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
function getDoneActivities() {
  let formData = new FormData();
  server(displayDoneActivities, "getDoneActivities", formData);
  function displayDoneActivities(response) {
    // console.log(response);
    // debugger;
    let container = ObjectId("doneActivities-container");
    //clear the container
    container.innerHTML = "";
    // append new children to the container
    response.forEach((dataRow) => {
      let div = document.createElement("div");
      div.classList.add(
        "card",
        "timeline-item",
        "position-relative",
        "rounded",
        "mb-2",
        "border",
        "shadow",
        "cursor-pointer"
      );
      let rowContent = `
        <div class="card-header fw-bolder border-0 bg-white p-0 d-flex justify-content-between p-2">
          <span class="gs-fs-8">${dataRow.title}</span>
          <span class="gs-fs-8">${dataRow.dueDate}</span>
        </div>
        `;
      div.innerHTML = rowContent;
      // redirect to intore particulars page
      div.onclick = () => {
        sessionStorage.setItem("activityParticularId", dataRow.id);
        window.location.href = "activitiesParticular.php";
      };
      container.appendChild(div);
    });
  }
}
