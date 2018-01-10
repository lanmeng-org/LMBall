@extends('admin.layouts.main')

@section('title')
  域名详情 - {{ $domain->name }}
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            <a href="{{ route('admin.domain.index') }}" class="btn btn-default">返回列表</a>
            <a href="{{ route('admin.url.index', ['domain' => $domain->getKey()]) }}" class="btn btn-primary">URL管理</a>
          </h3>
          <div class="box-tools"></div>
        </div>

        <div class="box-body">

        </div>

        <div class="box-footer clearfix">
        </div>
      </div>
    </div>
  </div>
@endsection


