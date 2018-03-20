@extends('prio1.layouts')
@section('content')
<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
  <main role="main" class="inner cover">
    <h1 class="cover-heading">Import JSON file</h1>
    <p class="lead">This page  json </p>
    <p class="lead">
      <form class="" action="{{route('import.import')}}" method="post" enctype="multipart/form-data">
        <input type="file" name="ipfile" value="">
        <button type="submit" name="btnSubmit">Import</button>
      </form>
      <a href="{{route('prio1.start')}}" class="btn btn-lg btn-secondary">Start quiz</a>
    </p>
  </main>
</div>
@endsection
