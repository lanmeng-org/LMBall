@extends('admin.layouts.main')

@section('title')
  @if(isset($data))
    编辑角色 - {{ $data->display_name }}
  @else
    新增角色
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        @if(isset($data))
          {{ Form::model($data, ['route' => ['admin.rbac.role.update', $data->id], 'method' => 'put']) }}
        @else
          {{ Form::open(['route' => 'admin.rbac.role.store', 'method' => 'post']) }}
        @endif
        <div class="box-body">
          <div class="col-sm-6">
            @include('admin.widgets.tips')

            <div class="form-group">
              <label for="name">规则标识</label>
              {{ Form::input('text', 'name', null, [
                  'class' => 'form-control',
                  'id' => 'name'
                  ]) }}
            </div>

            <div class="form-group">
              <label for="display_name">显示名称</label>
              {{ Form::input('text', 'display_name', null, [
                  'class' => 'form-control',
                  'id' => 'display_name'
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
              <label for="permissions">权限分配</label>
              {{ Form::select('permissions[]', $permissions, $selectPermissions, [
                'id' => 'permissions',
                'class' => 'form-control select2',
                'multiple' => 'multiple',
                'data-placeholder' => '点击选择',
              ]) }}
            </div>

            <div class="col-sm-6">
              <div class="box-footer text-center">
                <a href="{{ route('admin.rbac.role.index') }}" class="btn btn-default">取消</a> &nbsp;
                <button type="submit" class="btn btn-info">提交</button>
              </div>
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
