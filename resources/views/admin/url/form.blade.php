@extends('admin.layouts.main')

@section('title')
  @if(isset($url))
    编辑URL - {{ $url->url }}
  @else
    新增域名
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        @if(isset($url))
          {{ Form::model(
            $url,
            [
              'route' => ['admin.url.update', $domain->getKey(), $url->getKey()],
              'method' => 'put'
            ]
          ) }}
        @else
          {{ Form::open([
            'route' => ['admin.url.store', $domain->getKey()],
            'method' => 'post'
          ]) }}
        @endif
          <div class="box-body">
            <div class="col-sm-6">
              @include('admin.widgets.tips')

              <div class="form-group">
                <label for="url">URL地址</label>
                {{ Form::text('url', null, [
                  'class' => 'form-control',
                  'id' => 'url'
                ]) }}
              </div>

              <div class="form-group">
                <label for="redirect_url">跳转地址</label>
                {{ Form::text('redirect_url', null, [
                  'class' => 'form-control',
                  'id' => 'redirect_url'
                ]) }}
              </div>

              <div class="form-group">
                <label for="description">简介</label>
                {{ Form::text('description', null, [
                  'class' => 'form-control',
                  'id' => 'description'
                ]) }}
              </div>

              <div class="box-footer text-center">
                <a href="{{ route('admin.url.index', ['domain' => $domain->getKey()]) }}" class="btn btn-default">取消</a> &nbsp;
                <button type="submit" class="btn btn-info">提交</button>
              </div>
            </div>
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
@endsection
