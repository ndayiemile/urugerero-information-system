// projected attendance rate chart
let options_chartForProjectedAttendanceRate = {
  series: [
    {
      name: "Kamuhoza",
      data: [31, 40, 28, 51, 42, 109, 100],
    },
    {
      name: "Katabaro",
      data: [11, 32, 45, 32, 34, 52, 41],
    },
    {
      name: "Kimisagara",
      data: [1, 72, 35, 52, 34, 42, 61],
    },
  ],
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
          filename: "projected attendance rate",
        },
        png: {
          filename: "projected attendance rate",
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
    categories: [
      "2018-09-19T00:00:00.000Z",
      "2018-09-19T01:30:00.000Z",
      "2018-09-19T02:30:00.000Z",
      "2018-09-19T03:30:00.000Z",
      "2018-09-19T04:30:00.000Z",
      "2018-09-19T05:30:00.000Z",
      "2018-09-19T06:30:00.000Z",
    ],
  },
  tooltip: {
    x: {
      format: "dd/MM/yy HH:mm",
    },
  },
};

let chart_chartForProjectedAttendanceRate = new ApexCharts(
  document.querySelector("#chartForProjectedAttendanceRate"),
  options_chartForProjectedAttendanceRate
);
chart_chartForProjectedAttendanceRate.render();

let options_chartForCellDataOverView1 = {
  series: [13, 23, 21, 17, 31],
  labels: ["Active", "Unknown", "Job", "Sick", "Studying"],
  chart: {
    type: "polarArea",
  },
  stroke: {
    colors: ["#fff"],
  },
  fill: {
    opacity: 0.8,
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

let chart_chartForCellDataOverView1 = new ApexCharts(
  document.querySelector("#chartForCellDataOverView1"),
  options_chartForCellDataOverView1
);
chart_chartForCellDataOverView1.render();

let options_chartForCellDataOverView2 = {
  series: [33, 13, 20, 25, 21],
  labels: ["Active", "Unknown", "Job", "Sick", "Studying"],
  chart: {
    type: "polarArea",
  },
  stroke: {
    colors: ["#fff"],
  },
  fill: {
    opacity: 0.8,
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

let chart_chartForCellDataOverView2 = new ApexCharts(
  document.querySelector("#chartForCellDataOverView2"),
  options_chartForCellDataOverView2
);
chart_chartForCellDataOverView2.render();

let options_chartForCellDataOverView3 = {
  series: [13, 23, 41, 17, 17],
  labels: ["Active", "Unknown", "Job", "Sick", "Studying"],
  chart: {
    type: "polarArea",
  },
  stroke: {
    colors: ["#fff"],
  },
  fill: {
    opacity: 0.8,
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

let chart_chartForCellDataOverView3 = new ApexCharts(
  document.querySelector("#chartForCellDataOverView3"),
  options_chartForCellDataOverView3
);
chart_chartForCellDataOverView3.render();

      
let options_chartForSectorDataOverview = {
  series: [44, 55, 41, 17, 15],
  labels: ["Active", "Unknown", "Job", "Sick", "Studying"],
  chart: {
  type: 'donut',
},
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
      width: 300
    },
    legend: {
      position: 'right'
    }
    
  }
}]
};

let chart_chartForSectorDataOverview = new ApexCharts(document.querySelector("#chartForSectorDataOverview"), options_chartForSectorDataOverview);
chart_chartForSectorDataOverview.render();
