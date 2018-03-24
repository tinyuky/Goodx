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
                  style="{{ $errors->has('q'.$data['id'])?'color:red':''}}">
              {{$data['question']}}
            </h4>
            <div class="d-block my-12">
              @if(count($data['answer'])==3)
                @foreach($data['answer'] as $answer)
                <div class="custom-control custom-radio">
                  <input id="{{$answer->id}}" name="q{{$data['id']}}"
                      type="radio" class="custom-control-input"
                        value="{{$answer->id}}"
                          {{old('q'.$data['id'])==$answer->id ? 'checked' :''}}>
                  <label class="custom-control-label" for="{{$answer->id}}">{{$answer->answer}}</label>
                </div>
                @endforeach
              @else
              <div class="custom-control custom-radio">
                <input id="{{$data['answer'][0]->id}}T" name="q{{$data['id']}}"
                      type="radio" class="custom-control-input"
                        value="TRUE"
                          {{old('q'.$data['id'])=='TRUE' ? 'checked': ''}}>
                <label class="custom-control-label" for="{{$data['answer'][0]->id}}T">TRUE</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="{{$data['answer'][0]->id}}F" name="q{{$data['id']}}"
                      type="radio" class="custom-control-input"
                        value="FALSE"
                          {{old('q'.$data['id'])=='FALSE' ? 'checked' : ''}}>
                <label class="custom-control-label" for="{{$data['answer'][0]->id}}F">FALSE</label>
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
