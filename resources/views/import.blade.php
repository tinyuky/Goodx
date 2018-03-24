@extends('layouts')
@section('content')
<br>
  <div class="container text-center">
    <h1 class="jumbotron-heading">IMPORT YOUR JSON FILE</h1>
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
@endsection
