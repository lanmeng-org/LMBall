@extends('layouts.html')

@section('title')
后台管理 | 登录页面
@endsection

@section('styles')
  @parent
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/admin-lte/css/AdminLTE.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/admin-lte/css/skins/skin-blue-light.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/admin-lte-plugins/iCheck/square/blue.css') }}">
@endsection

@section('body-class')
  hold-transition login-page
@endsection

@section('body')
  <div class="login-box">
    <div class="login-logo">登录</div>

    <div class="login-box-body">

      <form role="form" method="POST" action="{{ route('admin.login') }}">
        {!! csrf_field() !!}

        <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
          <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                 placeholder="用户名">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

          @if ($errors->has('name'))
            <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
          <input type="password" name="password" class="form-control"
                 placeholder="密码">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>

          @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group has-feedback{{ $errors->has('verify_code') ? ' has-error' : '' }}">
          <input type="text" name="verify_code" class="form-control"
                 placeholder="验证码">
          <span class="glyphicon glyphicon-text-background form-control-feedback"></span>

          <span class="help-block">
            @if ($errors->has('verify_code'))
              <strong>{{ $errors->first('verify_code') }}</strong>
            @endif
          </span>
          <img src="{{ captcha_src('admin_login') }}" alt="验证码" width="100%" role="button" id="verify_code_image">
        </div>

        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" name="remember" id="remember"> 记住登录
              </label>
            </div>
          </div>

          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
          </div>
        </div>
      </form>

    </div>
  </div>
@endsection

@section('scripts')
  @parent
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendor/admin-lte-plugins/iCheck/icheck.min.js') }}"></script>
  <script>
    $(function () {
      $('.icheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
      });

      $('#verify_code_image').click(function () {
        $(this).attr('src', '{{ captcha_src('admin_login') }}_' + Math.random())
      });
    });
  </script>
@endsection
