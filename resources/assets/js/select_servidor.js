import Vue from 'vue';

Vue.component('servidores', {

  props:['user_edit'],
  template: `
  <select class="form-control select2" style="width: 100%;" name="empregado_id">
    <servidor v-for="task in tasks" :name="task.name" :empregado_id="task.id" :user_id="task.user_id" :user_edit="user_edit"></servidor>
  </select>
  `,

  data(){
    return {
      tasks: [

      ]
    }
  },


  mounted(){
    axios.get('/empregados/apiServidor').then(response => this.tasks = response.data);
  }
});

Vue.component('servidor', {
  props: ['empregado_id','name','user_id', 'user_edit'],
  template: `
    <option :value="empregado_id" v-if="user_id === null">{{ name }}</option>
    <option :value="empregado_id" v-else-if="empregado_id === user_edit" selected="selected">{{ name }}</option>
    <option :value="empregado_id" v-else disabled="disabled" >{{ name }}</option>
  `

});
//EquipesComponent
Vue.component('equipes', {

  props:['equipe_edit'],
  template: `
  <select class="form-control select2" style="width: 100%;" name="empregado_id">
    <equipe v-for="task in tasks" :name="task.name" :empregado_id="task.id" :membro_equipe="task.equipe" :equipe_edit="equipe_edit"></equipe>
  </select>
  `,

  data(){
    return {
      tasks: [

      ]
    }
  },


  mounted(){
    axios.get('/empregados/apiEquipe').then(response => this.tasks = response.data);
  }
});


//EquipeComponet
Vue.component('equipe', {
  props: ['empregado_id','name','equipe_edit','membro_equipe'],
  template: `
    <option :value="empregado_id" v-if="membro_equipe === null">{{ name }}</option>
    <option :value="empregado_id" v-else-if="empregado_id === equipe_edit" selected="selected">{{ name }}</option>
    <option :value="empregado_id" v-else disabled="disabled" >{{ name }}</option>
  `
});

//ProfessorsComponent
Vue.component('professors', {

  props:['professor_edit'],
  template: `
  <select class="form-control select2" style="width: 100%;" name="empregado_id">
    <professor v-for="task in tasks" :name="task.name" :empregado_id="task.id" :professor="task.professor" :professor_edit="professor_edit"></professor>
  </select>
  `,

  data(){
    return {
      tasks: [

      ]
    }
  },


  mounted(){
    axios.get('/empregados/apiProfessor').then(response => this.tasks = response.data);
  }
});


//ProfessorComponent
Vue.component('professor', {
  props: ['empregado_id','name','professor_edit','professor'],
  template: `
    <option :value="empregado_id" v-if="professor === null">{{ name }}</option>
    <option :value="empregado_id" v-else-if="empregado_id === professor_edit" selected="selected">{{ name }}</option>
    <option :value="empregado_id" v-else disabled="disabled" >{{ name }}</option>
  `
});

//DisciplinasComponent
Vue.component('disciplinas', {

  props:['disciplina_edit'],
  template: `
  <select class="form-control select2" style="width: 100%;" name="professor_id">
    <disciplina v-for="task in tasks" :professor="task.professor" :professor_id="task.id" :disciplina_edit="disciplina_edit"></disciplina>
  </select>
  `,

  data(){
    return {
      tasks: [

      ]
    }
  },


  mounted(){
    axios.get('/horarios/apiProfessor').then(response => this.tasks = response.data);
  }
});


//DisciplinaComponent
Vue.component('disciplina', {
  props: ['professor_id','professor','disciplina_edit'],
  template: `
    <option :value="professor_id" v-if="professor_id === disciplina_edit" selected="selected">{{ professor }}</option>
    <option :value="professor_id" v-else >{{ professor }}</option>
  `
});
var app = new Vue({
  el: '#formulario'
});
