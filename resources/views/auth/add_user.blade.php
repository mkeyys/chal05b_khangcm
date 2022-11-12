@extends('layouts.index')
@section('content')

    <form role="form" action="{{route('/user/add_user')}}" method="POST" class="mt-5">
        @csrf
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Tên đăng nhập</label>
            <div class="col-lg-9">
                <input class="form-control" type="text" name="username" value=""/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Mật khẩu</label>
            <div class="col-lg-9">
                <input class="form-control" type="password" name="password" value=""/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Họ tên</label>
            <div class="col-lg-9">
                <input class="form-control" type="text" name="name" value=""/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Email</label>
            <div class="col-lg-9">
                <input class="form-control" type="email" name="email" value=""/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Số điện thoại</label>
            <div class="col-lg-9">
                <input class="form-control" type="text" name="phone_number" value=""/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-9 ml-auto text-right">
                <button type="submit" class="btn btn-primary">Thêm sinh viên</button>
            </div>
        </div>
    </form>
@endsection
