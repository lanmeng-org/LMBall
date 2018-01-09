@extends('admin.layouts.main')

@section('title')
  我的资料
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        {{ Form::model($data, ['route' => 'admin.profile.update', 'method' => 'put']) }}
        <div class="box-body">
          <div class="col-sm-6">
            @include('admin.widgets.tips')

            <div class="form-group">
              <label for="name">用户名</label>
              {{ Form::input('text', 'name', null, [
                  'class' => 'form-control',
                  'id' => 'name'
                  ]) }}
            </div>

            <div class="form-group">
              <label for="email">邮箱</label>
              {{ Form::input('email', 'email', null, [
                'class' => 'form-control',
                'id' => 'email'
              ]) }}
            </div>

            <div class="form-group">
              <label for="password">密码</label>
              {{ Form::input('password', 'password', null, [
                'class' => 'form-control',
                'id' => 'password'
              ]) }}
            </div>

            <div class="box-footer text-center">
              <button type="submit" class="btn btn-info">提交</button>
            </div>
          </div>

        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
@endsection
