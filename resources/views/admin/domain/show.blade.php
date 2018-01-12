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

          <div class="row">
            {{--URL排行--}}
            <div class="col-md-6">

            </div>
            {{--来路分析--}}
            <div class="col-md-6">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                  <li>
                    <a href="#tab_referer_url" data-toggle="tab">地址</a>
                  </li>
                  <li class="active">
                    <a href="#tab_referer_domain" data-toggle="tab">域名</a>
                  </li>
                  <li class="pull-left header">
                    <i class="fa fa-th"></i>来路分析
                  </li>
                </ul>

                <div class="tab-content">
                  {{--来路域名--}}
                  <div class="tab-pane active" id="tab_referer_domain">
                    @include('admin.domain._referer_domain')
                  </div>

                  {{--来路URL--}}
                  <div class="tab-pane" id="tab_referer_url">
                    @include('admin.domain._referer_url')
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{--区域分布--}}
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">区域分布</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body" id="count_region" style="height: 50vw;"></div>
          </div>
          <div class="row">
            {{--国家与运营商--}}
            <div class="col-lg-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">国家与运营商</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                      <i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>

                <div id="count_country" class="box-body" style="height: 30vw;"></div>
              </div>
            </div>
            {{--系统与浏览器--}}
            <div class="col-lg-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">系统与浏览器</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                      <i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>

                <div id="count_os" class="box-body" style="height: 30vw;"></div>
              </div>
            </div>
          </div>
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


