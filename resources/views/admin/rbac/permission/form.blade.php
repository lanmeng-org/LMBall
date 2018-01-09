@extends('admin.layouts.main')

@section('title')
  @if(isset($data))
    编辑权限 - {{ $data->display_name }}
  @else
    新增权限
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        @if(isset($data))
          {{ Form::model($data, ['route' => ['admin.rbac.permission.update', $data->id], 'method' => 'put']) }}
        @else
          {{ Form::open(['route' => 'admin.rbac.permission.store', 'method' => 'post']) }}
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

            <div class="box-footer text-center">
              <a href="{{ route('admin.rbac.permission.index') }}" class="btn btn-default">取消</a> &nbsp;
              <button type="submit" class="btn btn-info">提交</button>
            </div>
          </div>
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
@endsection
