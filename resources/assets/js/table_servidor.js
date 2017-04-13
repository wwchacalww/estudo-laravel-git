import Vue from 'vue';

// Vue.component('lista_servidores',{
//   template: `
//   <div class="box">
//
//     <div class="box-body">
//       <table class="table table-bordered table-striped" id="example1">
//         <thead>
//         <tr>
//           <th>Nome</th>
//           <th>Email</th>
//           <th>Função</th>
//           <th>CH</th>
//           <th>Opções</th>
//         </tr>
//         </thead>
//         <tbody>
//         <tr v-for="task in tasks">
//           <td>{{ task.name }}</td>
//           <td>{{task.email}}</td>
//           <td>{{task.funcao}}</td>
//           <td>{{task.ch}}</td>
//           <td>X</td>
//         </tr>
//
//         </tbody>
//         <tfoot>
//         <tr>
//           <th>Nome</th>
//           <th>Email</th>
//           <th>Função</th>
//           <th>CH</th>
//           <th>Opções</th>
//         </tr>
//         </tfoot>
//       </table>
//     </div>
//     <!-- /.box-body -->
//   </div>
//   <!-- /.box -->
//   `,
//
//   data(){
//     return {
//       tasks: [
//
//       ],
//       sort: {
//         column: 'name',
//         reverse: 1
//       }
//     }
//   },
//
//
//   mounted(){
//     axios.get('/empregados/apiServidor').then(response => this.tasks = response.data);
//   }
//
// });
new Vue({
  el: '#table_servidor',
  data(){
    return{
      tasks: []
    }
  },
  mounted(){
    axios.get('/empregados/apiServidor').then(response => this.tasks = response.data);
  }

})
