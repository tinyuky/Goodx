
  <template>
  <div class="text-center">
  <h1 class="jumbotron-heading">RESULT OF YOUR QUIZ</h1>
  <p class="lead text-muted">You correct {{this.$route.params.correct}} questions</p>
  <p class="lead text-muted">You must enter your name and email for saving your result</p>
  <p>
    <form @submit.prevent="validateBeforeSubmit">
      <input type="text" v-validate="'required'" v-model="user.name" name="name" class="form-control" placeholder="Your name">
      <br>
      <input type="email" v-validate="'required|email'" v-model="user.email" name="email" class="form-control" placeholder="Your email">
      <br>
      <button class="btn btn-lg btn-primary" type="submit">Finish</button>
    </form>
  </p>
  </div>
  </template>
  <script>
  export default{
    data: function () {
        return {
          user:{
            name:'',
            email:'',
            score: this.$route.params.correct
          }
        }
    },
    methods:{
      //validate user input
      validateBeforeSubmit() {
        var app = this;
        app.$validator.validateAll().then((result) => {
          //no error
          if (result) {
            // create user api
            axios.post('/api/create', app.user)
                      .then(function (resp) {
                          app.$router.push({ name : 'quiz-thank' });
                      })
                      .catch(function (resp) {
                          console.log(resp);
                          alert("Error!");
                      });
          }
          //show error
          else{
            alert('Please fill all information');
          }
        });
      }
    }
  }
  </script>
