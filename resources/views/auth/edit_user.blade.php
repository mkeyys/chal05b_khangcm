@extends('layouts.index')
@section('content')

    <form role="form" class="mt-5" action="{{route('/user/edit',$user->username)}}" method="POST">
        @csrf
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Tên đăng nhập</label>
            <div class="col-lg-9">
                <input class="form-control" type="text" name="username" value={{$user->username}} @if (Auth::user()->level == 0) readonly @endif>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Mật khẩu</label>
            <div class="col-lg-9">
                <input class="form-control" type="text" name="password" value="">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Họ tên</label>
            <div class="col-lg-9">
                <input class="form-control" name="name" value="{{$user->name}}" @if (Auth::user()->level == 0) readonly @endif>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Email</label>
            <div class="col-lg-9">
                <input class="form-control" type="email" name="email" value={{$user->email}}>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Số điện thoại</label>
            <div class="col-lg-9">
                <input class="form-control" type="text" name="phone_number" value={{$user->phone_number}}>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-9 ml-auto text-right">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </form>
@endsection
