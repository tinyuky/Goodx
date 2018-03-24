
<template>
<div class="container">
      <div class="py-5 text-center">
        <h2>QUIZ</h2>
        <p class="lead">Below is your quiz. Good luck</p>
      </div>
      <form @submit.prevent="validateBeforeSubmit">
      <div class="row">
        <div class="col-md-12 order-md-2 mb-4" v-for="(data,n) in quiz">
            <hr class="mb-12">
            <h4 class="mb-12">{{data.question}}</h4>
            <div class="d-block my-12">
                <div class="custom-control custom-radio"
                      v-if="data.answer.length==3"
                        v-for="answer in data.answer">
                  <input :id="answer.id" :name="data.id"
                      type="radio" class="custom-control-input"
                        :value="answer.id" v-model="count[n]" v-validate="'required'">
                  <label class="custom-control-label" :for="answer.id">{{answer.answer}}</label>
                </div>
                <div v-else>
                  <div class="custom-control custom-radio">
                    <input :id="data.id+'true'" :name="data.id"
                        type="radio" class="custom-control-input"
                          :value="data.answer[0].id+'-TRUE'" v-model="count[n]" v-validate="'required'">
                    <label class="custom-control-label" :for="data.id+'true'">TRUE</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input :id="data.id+'false'" :name="data.id"
                        type="radio" class="custom-control-input"
                          :value="data.answer[0].id+'-FALSE'" v-model="count[n]" v-validate="'required'">
                    <label class="custom-control-label" :for="data.id+'false'">FALSE</label>
                  </div>
                </div>
              <hr class="mb-4">
          </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block" name="button">Apply</button>
  </form>
  </div>
</template>
<script>
export default {
  data: function () {
      return {
          quiz: [],
          count: []
      }
  },
  mounted() {
      var app = this;
      //get quiz from api
      axios.get('/api/show')
          .then(function (resp) {
              app.quiz = resp.data;
          })
          .catch(function (resp) {
              console.log(resp);
              alert("Could not load quiz");
          });
  },
  methods: {
    //validate quiz
    validateBeforeSubmit() {
      var app = this;
      this.$validator.validateAll().then((result) => {
        //no error
        if (result) {
          axios.post('/api/check', app.count)
                    .then(function (resp) {
                        //resirect to result component
                        app.$router.push({ path:'/result/'+ resp.data["result"] });
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Error!");
                    });
        }
        //show error
        else{
          alert('Please answer all question','Gooqx');
        }
      });
    }
  }
}
</script>
