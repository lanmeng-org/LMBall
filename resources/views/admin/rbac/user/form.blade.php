@extends('admin.layouts.main')

@section('title')
  @if(isset($data))
    编辑用户 - {{ $data->name }}
  @else
    新增用户
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        @if(isset($data))
          {{ Form::model($data, ['route' => ['admin.rbac.user.update', $data->id], 'method' => 'put']) }}
        @else
          {{ Form::open(['route' => 'admin.rbac.user.store', 'method' => 'post']) }}
        @endif
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
                <label for="password">密码</label>
                {{ Form::input('password', 'password', null, [
                    'class' => 'form-control',
                    'id' => 'password'
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
                <label for="role">所属角色</label>
                {{ Form::select('roles[]', $roles, $selectRole, [
                  'id' => 'role',
                  'class' => 'form-control select2',
                  'multiple' => 'multiple',
                  'data-placeholder' => '点击选择',
                ]) }}
              </div>

              <div class="box-footer text-center">
                <a href="{{ route('admin.rbac.user.index') }}" class="btn btn-default">取消</a> &nbsp;
                <button type="submit" class="btn btn-info">提交</button>
              </div>
            </div>
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
@endsection

@section('after_styles')
  <link rel="stylesheet" href="{{ asset('vendor/admin-lte-plugins/') }}/select2/select2.min.css">
@endsection

@section('after_scripts')
  @parent
  <script src="{{ asset('vendor/admin-lte-plugins') }}/select2/select2.full.min.js"></script>
  <script>
    $(".select2").select2();
  </script>
@endsection
