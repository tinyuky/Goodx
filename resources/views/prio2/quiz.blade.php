@extends('layouts')
@section('content')
<div class="container">
      <div class="py-5 text-center">
        <h2>QUIZ</h2>
        <p class="lead">Below is your quiz. Good luck</p>
      </div>
      <div class="row">
        <div class="col-md-12 order-md-2 mb-4">
          <form action="{{route('quiz.submit')}}" method="post">
            {!! csrf_field() !!}
            @foreach($data as $data)
            <hr class="mb-12">
            <h4 class="mb-12"
                  style="{{ $errors->has('q'.$data['question']->id)?'color:red':''}}">
              {{$data['question']->question}}
            </h4>
            <div class="d-block my-12">
              @if(count($data['ans'])==3)
                @foreach($data['ans'] as $ans)
                <div class="custom-control custom-radio">
                  <input id="{{$ans->id}}" name="q{{$data['question']->id}}"
                      type="radio" class="custom-control-input"
                        value="{{$ans->id}}"
                          {{old('q'.$data['question']->id)==$ans->id ? 'checked' :''}}>
                  <label class="custom-control-label" for="{{$ans->id}}">{{$ans->answer}}</label>
                </div>
                @endforeach
              @else
              <div class="custom-control custom-radio">
                <input id="{{$data['ans'][0]->id}}T" name="q{{$data['question']->id}}"
                      type="radio" class="custom-control-input"
                        value="TRUE"
                          {{old('q'.$data['question']->id)=='TRUE' ? 'checked' :''}}>
                <label class="custom-control-label" for="{{$data['ans'][0]->id}}T">TRUE</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="{{$data['ans'][0]->id}}F" name="q{{$data['question']->id}}"
                      type="radio" class="custom-control-input"
                        value="FALSE"
                          {{old('q'.$data['question']->id)=='FALSE' ? 'checked' :''}}>
                <label class="custom-control-label" for="{{$data['ans'][0]->id}}F">FALSE</label>
              </div>
              @endif
            <hr class="mb-4">
            @endforeach
            <button class="btn btn-primary btn-lg btn-block" type="submit">Submit quiz</button>
          </div>
        </form>
      </div>
    </div>
@endsection
