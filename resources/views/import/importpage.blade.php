@extends('layouts')
@section('content')
<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
  <main role="main" class="inner cover">
    <h1 class="cover-heading">Import JSON file</h1>
    <p class="lead">This page help you import question json file </p>
    <p class="lead">
      <form class="" action="{{route('import.import')}}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="input-group">
          <input type="text" name="url" class="form-control" placeholder="Url">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Import</button>
          </div>
        </div>
        @if ($errors->has('url'))
          <span class="help-block help-block-error danger"
                style="color: red">{{$errors->first('url')}}</span>
        @endif
      </form>
    </p>
  </main>
</div>
@endsection
