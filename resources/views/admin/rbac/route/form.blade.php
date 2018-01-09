@extends('admin.layouts.main')

@section('title')
  @if(isset($data))
    编辑路由 - {{ $data->display_name }}
  @else
    新增路由
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        @if(isset($data))
          {{ Form::model($data, ['route' => ['admin.rbac.route.update', $data->id], 'method' => 'put']) }}
        @else
          {{ Form::open(['route' => 'admin.rbac.route.store', 'method' => 'post']) }}
        @endif
        <div class="box-body">
          <div class="col-sm-6">
            @include('admin.widgets.tips')

            <div class="form-group">
              <label for="route">路由</label>
              {{ Form::input('text', 'route', null, [
                'class' => 'form-control',
                'id' => 'route'
              ]) }}
            </div>

            <div class="form-group">
              <label for="description">描述</label>
              {{ Form::input('text', 'description', null, [
                'class' => 'form-control',
                'id' => 'description'
              ]) }}
            </div>

            <div class="form-group">
              <label>分配权限</label>
              {{ Form::select('permissions[]', $permission, $selectPermission, [
                'id' => 'role',
                'class' => 'form-control select2',
                'multiple' => 'multiple',
                'data-placeholder' => '点击选择',
              ]) }}
            </div>

            <div class="form-group">
              <label>分配角色</label>
              {{ Form::select('roles[]', $role, $selectRole, [
                  'id' => 'role',
                  'class' => 'form-control select2',
                  'multiple' => 'multiple',
                  'data-placeholder' => '点击选择',
                ]) }}
            </div>

            <div class="box-footer text-center">
              <a href="{{ route('admin.rbac.route.index') }}" class="btn btn-default">取消</a> &nbsp;
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
