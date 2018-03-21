@extends('layouts')
@section('content')
<div class="container">
      <div class="py-5 text-center">
        <h2>QUIZ</h2>
        <p class="lead">Below is your quiz. Good luck</p>
      </div>

      <div class="row">
        <div class="col-md-12 order-md-2 mb-4">
          <form class="needs-validation" novalidate>
            @for($i=0;$i<5;$i++)
            <hr class="mb-12">
            <h4 class="mb-12">{{$data[$i]['question']->question}}</h4>
            <div class="d-block my-12">
              @if(count($data[$i]['ans'])==3)
                @foreach($data[$i]['ans'] as $ans)
                <div class="custom-control custom-radio">
                  <input id="{{$ans->id}}" name="ques{{$i}}" type="radio" class="custom-control-input" value="" required>
                  <label class="custom-control-label" for="{{$ans->id}}">{{$ans->answer}}</label>
                </div>
                @endforeach
              @else
              <div class="custom-control custom-radio">
                <input id="{{$data[$i]['ans'][0]->id}}" name="ques{{$i}}" type="radio" class="custom-control-input" value="" required>
                <label class="custom-control-label" for="{{$data[$i]['ans'][0]->id}}">TRUE</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="{{$data[$i]['ans'][0]->id}}" name="ques{{$i}}" type="radio" class="custom-control-input" value="" required>
                <label class="custom-control-label" for="{{$data[$i]['ans'][0]->id}}">FALSE</label>
              </div>
              @endif
            <hr class="mb-4">
            @endfor
            <button class="btn btn-primary btn-lg btn-block" type="submit">Submit quiz</button>
            </form>
        </div>
      </div>
    </div>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
@endsection
