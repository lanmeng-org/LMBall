@extends('admin.layouts.main')

@section('title')
  @if(isset($data))
    编辑域名 - {{ $data->name }}
  @else
    新增域名
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        @if(isset($data))
          {{ Form::model($data, ['route' => ['admin.domain.update', $data->id], 'method' => 'put']) }}
        @else
          {{ Form::open(['route' => 'admin.domain.store', 'method' => 'post']) }}
        @endif
          <div class="box-body">
            <div class="col-sm-6">
              @include('admin.widgets.tips')

              <div class="form-group">
                <label for="name">域名</label>
                {{ Form::text('name', null, [
                  'class' => 'form-control',
                  'id' => 'name'
                ]) }}
              </div>

              <div class="form-group">
                <label for="description">简介</label>
                {{ Form::text('description', null, [
                  'class' => 'form-control',
                  'id' => 'description'
                ]) }}
              </div>

              <div class="form-group">
                <label for="weight">排序</label>
                {{ Form::number('weight', $data->weight ?? 0, [
                  'class' => 'form-control',
                  'id' => 'weight'
                ]) }}
              </div>

              <div class="box-footer text-center">
                <a href="{{ route('admin.domain.index') }}" class="btn btn-default">取消</a> &nbsp;
                <button type="submit" class="btn btn-info">提交</button>
              </div>
            </div>
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
@endsection
