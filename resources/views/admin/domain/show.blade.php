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

          <div id="count_region" style="height: 50vw;"></div>
          <div id="count_country" style="height: 30vw;"></div>
          <div id="count_os" style="height: 30vw;"></div>
          <div id="count_referer_domain" style="height: 300px;"></div>
          <div id="count_referer_url" style="height: 300px;"></div>

        </div>

        <div class="box-footer clearfix">
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  @parent
  <script>
    var domain_id = '{{ $domain->getKey() }}';
  </script>
  <script src="{{ asset('/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('/vendor/echarts/map/js/china.js') }}"></script>
  <script src="{{ asset('/js/admin/domain.show.js') }}"></script>
@endsection


