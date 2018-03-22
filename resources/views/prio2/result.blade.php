@extends('layouts')
@section('content')
<div class="container text-center">
  @if(Session::has('result'))
  <h1 class="jumbotron-heading">RESULT OF YOUR QUIZ</h1>
  <p class="lead text-muted">You correct {{Session::get('result')}} questions</p>
  <p class="lead text-muted">You must enter your name and email for saving your result</p>
  <p>
    <form class="" action="{{route('quiz.finish')}}" method="post">
      {!! csrf_field() !!}
      <label for="inputEmail" class="sr-only">Your name</label>
      <input type="text" name="name" id="inputEmail" class="form-control" placeholder="Your name">
      @if ($errors->has('name'))
        <span class="help-block help-block-error danger"
              style="color: red">{{$errors->first('name')}}</span>
      @endif
      <br>
      <label for="inputPassword" class="sr-only">Your email</label>
      <input type="text" name="email" id="inputPassword" class="form-control" placeholder="Your email">
      @if ($errors->has('email'))
        <span class="help-block help-block-error danger"
              style="color: red">{{$errors->first('email')}}</span>
      @endif
      <br>
      <button class="btn btn-lg btn-primary" type="submit">Finish</button>
    </form>
  </p>
  @else
  <h1 class="jumbotron-heading">SORRY PUT YOU MUST FINISH THE QUIZ</h1>
  @endif
</div>
@endsection
