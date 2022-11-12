@extends('layouts.index')
@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div style="font-size: 1000%;"><i class="far fa-user"></i>
        </div>
        <div class="m-5">
            <span>Tên đăng nhập: {{Auth::user()->username}}</span><br>
            <span>Họ tên: {{Auth::user()->name}}</span><br>
            <span>Email: {{Auth::user()->email}}</span><br>
            <span>Số điện thoại: {{Auth::user()->phone_number}}</span>
        </div>
        <a href="/user/getEdit/{{Auth::user()->username}}" class="m-5" style="cursor: pointer;" title="Sửa thông tin"><i class="fas fa-pencil-alt"></i></a>

    </div>
@endsection
