@extends('layouts')
@extends('prio1.show')
@extends('prio1.token')
@section('content')
<template>
<div class="container">
      <div class="py-5 text-center">
        <h2>QUIZ</h2>
        <p class="lead">Below is your quiz. Good luck</p>
      </div>
      <form @submit.prevent="validateBeforeSubmit">
      <div class="row">
        <div class="col-md-12 order-md-2 mb-4" v-for="data in datas">
            <hr class="mb-12">
            <h4 class="mb-12">{{data.question}}</h4>
            <div class="d-block my-12">
                <div class="custom-control custom-radio"
                      v-if="data.answer.length==3"
                        v-for="answer in data.answer">
                  <input :id="answer.id" :name="data.id"
                      type="radio" class="custom-control-input"
                        :value="answer.id" :v-model="data.id" v-validate="'required'">
                  <label class="custom-control-label" :for="answer.id">{{answer.answer}}</label>
                </div>
                <div v-else>
                  <div class="custom-control custom-radio">
                    <input :id="data.id+'true'" :name="data.id"
                        type="radio" class="custom-control-input"
                          value="TRUE" :v-model="data.id" v-validate="'required'">
                    <label class="custom-control-label" :for="data.id+'true'">TRUE</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input :id="data.id+'false'" :name="data.id"
                        type="radio" class="custom-control-input"
                          value="FALSE" :v-model="data.id" v-validate="'required'">
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
          datas: []
      }
  },
  mounted() {
      var app = this;
      axios.get('/api/show')
          .then(function (resp) {
              app.datas = resp.data;
          })
          .catch(function (resp) {
              console.log(resp);
              alert("Could not load quiz");
          });
  },
  methods: {
    validateBeforeSubmit() {
      this.$validator.validateAll().then((result) => {
        if (result) {
          alert('Form Submitted!');
          return;
        }
        alert('Please answer all question');
      });
    }
  }
}




</script>
@endsection
