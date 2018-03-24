@extends('layouts')
@section('content')
      <br>
        <div class="container text-center">
          <h1 class="jumbotron-heading">WELCOME TO QUIZ</h1>
          <p class="lead text-muted">You will answer 5 random question from us</p>
          <p>
            <a href="{{route('quiz.show')}}" class="btn btn-primary my-2">Star quiz</a>
          </p>
        </div>
@endsection
