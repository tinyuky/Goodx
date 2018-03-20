@extends('prio1.layouts')
@section('content')
<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
  <main role="main" class="inner cover">
    <h1 class="cover-heading">NTT_Assignment</h1>
    <p class="lead">This is a quiz game. You must answer 5 random question from our question catalog</p>
    <p class="lead">
      <a href="{{route('prio1.start')}}" class="btn btn-lg btn-secondary">Start quiz</a>
    </p>
  </main>
</div>
@endsection
