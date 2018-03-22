@extends('layouts')
@section('content')
<header>
      <div class="collapse bg-white" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              @for($i=0;$i<count($users);$i++)
              <hr class="mb-12">
              <h4 class="mb-12"
                    style="{{ $users[$i]->id == $you ?'color:red':''}}">
                #{{$i+1}} - {{$users[$i]->name}} - {{$users[$i]->score}} score
              </h4>
              <hr class="mb-4">
              @endfor
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
          <h1 class="jumbotron-heading">THANKS FOR USING OUR QUIZ</h1>
          <p class="lead text-muted">See you next time</p>
          <p class="lead text-muted">You can see your result with another people in the menu</p>
        </div>
@endsection
