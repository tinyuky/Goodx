@extends('layouts')
@section('content')
  <template>
            <div class="container text-center">
              <h1 class="jumbotron-heading">WELCOME TO QUIZ</h1>
              <p class="lead text-muted">You will answer 5 random question from us</p>
              <router-link to="/show" class="btn btn-primary my-2">Start Quiz</router-link>             
            </div>
  </template>
@endsection
