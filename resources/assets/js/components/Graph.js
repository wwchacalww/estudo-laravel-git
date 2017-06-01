import Chart from 'chart.js';

// export default{
//   template: '<canvas width="500"></canvas>',
//   props: ['labels', 'values'],
//   mounted: function(){
//     var data = {
//       labels: this.labels,
//
//       datasets:[
//         {
//           fillColor: "rgba(220,220,220,0.2)",
//           strokeColor: "rgba(220,220,220,1)",
//           pointoColor: "rgba(220,220,220,1)",
//           pointStrokeColor: "#fff",
//           pointHighlightFill: "#fff",
//           pointHighlightStroke: "rgba(220,220,220,1)",
//           data: this.values
//         }
//         // {
//         //   fillColor: "rgba(100,220,220,0.7)",
//         //   strokeColor: "rgba(220,220,220,1)",
//         //   pointoColor: "rgba(220,220,220,1)",
//         //   pointStrokeColor: "#fff",
//         //   pointHighlightFill: "#fff",
//         //   pointHighlightStroke: "rgba(220,220,220,1)",
//         //   data: [10,52,2]
//         // }
//       ]
//     };
//
//     var context = $(this.$el);
//
//     new Chart(context,{
//       type: 'line',
//       data: data,
//       options:{
//         responsive: false
//       }
//     });
//   }
// }

export default{
  template: '<canvas height="500"></canvas>',
  props: ['turmas', 'total', 'atrasados', 'ocorrencias'],
  mounted: function(){
    //-------------
    //- BAR CHART -
    //-------------
    var areaChartData = {
      // labels: ["January", "February", "March", "April", "May", "June", "July"],
      labels: this.turmas,
      datasets: [
        {
          label: "Total de Alunos",
          backgroundColor: "rgba(54, 162, 235, 0.2)",
          borderColor: "rgba(54, 162, 235, 1)",
          borderWidth: 1,
          //data: [65, 59, 80, 81, 56, 55, 40]
          data: this.total
        },
        {
          label: "Alunos Atrasados",
          backgroundColor: "rgba(255, 99, 132, 0.2)",
          borderColor: "rgba(255,99,132,1)",
          borderWidth: 1,
          data: this.atrasados
        },
        {
          label: "Alunos Com Ocorrências",
          backgroundColor: "rgba(251, 117, 8, 0.6)",
          borderColor: "rgb(244, 100, 19, 1)",
          borderWidth: 1,
          data: this.ocorrencias
        }
      ]
    };
    var barChartCanvas = $(this.$el);
    // var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[1].fillColor = "#00a65a";
    barChartData.datasets[1].strokeColor = "#00a65a";
    barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    // barChart.Bar(barChartData, barChartOptions);
    new Chart(barChartCanvas, {
      type: 'bar',
      data: areaChartData,
      options:{

        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]


        }
      }
    });
  }

}
