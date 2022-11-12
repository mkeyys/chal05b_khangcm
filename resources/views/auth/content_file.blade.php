@extends('layouts.index')
@section('content')
    <h5 class="text-center mt-5 font-weight-bold">Bạn trả lời đúng rồi</h5><br>
    <div class="text-center font-italic" style="overflow:scroll; height: 400px">
        @foreach(file($linkfile) as $line)
        {{$line}}</br>
        @endforeach
    </div>
@endsection
