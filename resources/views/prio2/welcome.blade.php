@extends('layouts')
@section('content')
<header>
      <div class="collapse bg-white" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <form class="" action="{{route('ques.import')}}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="input-group">
                  <input type="text" name="url" class="form-control" placeholder="JSON FILE'S URL">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Import</button>
                  </div>
                </div>
                <br>
                @if ($errors->has('url'))
                  <span class="help-block help-block-error danger"
                        style="color: red">{{$errors->first('url')}}</span>
                @endif
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

      <br>
        <div class="container text-center">
          <h1 class="jumbotron-heading">WELCOME TO QUIZ</h1>
          <p class="lead text-muted">You will answer 5 random question from us</p>
          <p>
            <a href="{{route('quiz.show')}}" class="btn btn-primary my-2">Star quiz</a>
          </p>
        </div>
@endsection
