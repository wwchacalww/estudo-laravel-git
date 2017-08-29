// Construindo um classe para errors
class Errors {
  constructor() {
    this.errors = {};
  }

  get(field){
    if(this.errors[field]){
      return this.errors[field][0];
    }
  }

  record(errors){
    this.errors = errors;
  }
}

new Vue ({
  el: '#app',

  data:{
    turma_id: '',
    horario: '',
    disciplina_id: '',
    disciplinas: [],
    errors: new Errors()

  },

  methods:{
    turma: function(event){
      axios.get( '{{ url('horarios/turma_disciplinas') }}' ,{
        params:{
          q: this.turma_id
        }
      }).then(response => this.disciplinas = response.data);
    },

    onSubmit: function(){
      axios.post('{{url('horarios/store')}}', this.$data)
        .then(response=> alert('Deu certo'))
        .catch(error => this.errors.record(error.response.data));
    }

  }
