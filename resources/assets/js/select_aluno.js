import Vue from 'vue';

Vue.component('alunos', {

  props:['aluno_edit'],
  template: `
  <select class="form-control select2" multiple="multiple" data-placeholder="Digite o nome do aluno" style="width: 100%;" name="alunos[]">
    <aluno v-for="task in tasks" :name="task.nome +' - '+  task.turma.turma " :aluno_id="task.id" :aluno_edit="aluno_edit"></aluno>
  </select>
  `,

  data(){
    return {
      tasks: [

      ]
    }
  },


  mounted(){
    axios.get('/alunos/apiSelectAluno').then(response => this.tasks = response.data);
  }
});

Vue.component('aluno', {
  props: ['aluno_id','name', 'aluno_edit'],
  template: `
    <option :value="aluno_id" v-if="aluno_id === aluno_edit" selected="selected">{{ name }}</option>
    <option :value="aluno_id" v-else >{{ name }}</option>
  `

});
var app = new Vue({
  el: '#formulario'
});
