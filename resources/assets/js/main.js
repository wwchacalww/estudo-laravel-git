import Vue from 'vue';
import Graph from './components/Graph.js'


Vue.component('graph', Graph);
new Vue({
  el: '#root'
});

// import Chart from 'chart.js';
// var data = {
//   labels: ['Janeiro', 'Fevereiro', 'Março'],
//
//   datasets:[
//     {
//       fillColor: "rgba(220,220,220,0.2)",
//       strokeColor: "rgba(220,220,220,1)",
//       pointoColor: "rgba(220,220,220,1)",
//       pointStrokeColor: "#fff",
//       pointHighlightFill: "#fff",
//       pointHighlightStroke: "rgba(220,220,220,1)",
//       data: [30,122,90]
//     },
//     {
//       fillColor: "rgba(100,220,220,0.7)",
//       strokeColor: "rgba(220,220,220,1)",
//       pointoColor: "rgba(220,220,220,1)",
//       pointStrokeColor: "#fff",
//       pointHighlightFill: "#fff",
//       pointHighlightStroke: "rgba(220,220,220,1)",
//       data: [10,52,2]
//     }
//   ]
// };
//
// var context = $("#graph");
//
// new Chart(context,{
//   type: 'line',
//   data: data
// });
