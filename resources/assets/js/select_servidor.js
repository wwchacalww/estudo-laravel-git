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
new Vue({
  el: '#formulario'
});
