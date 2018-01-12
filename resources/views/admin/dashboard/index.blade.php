@extends('admin.layouts.main')

@section('title')
  网站概况
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $domainNumber }}</h3>
          <p>域名数量</p>
        </div>
        <div class="icon"><i class="fa fa-globe"></i></div>
        <a href="{{ route('admin.domain.index') }}" class="small-box-footer">
          查看更多 <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $urlNumber }}</h3>
          <p>URL数量</p>
        </div>
        <div class="icon"><i class="fa fa-link"></i></div>
        <a href="{{ route('admin.domain.index') }}" class="small-box-footer">
          查看更多 <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ $viewNumber['lastWeek'] }}</h3>
          <p>近7日访问量</p>
        </div>
        <div class="icon">
          <i class="fa fa-eye-slash"></i>
        </div>
        <a href="#" class="small-box-footer">查看更多 <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{ $viewNumber['lastMonth'] }}</h3>
          <p>近30日访问量</p>
        </div>
        <div class="icon">
          <i class="fa fa-eye"></i>
        </div>
        <a href="#" class="small-box-footer">查看更多 <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

@endsection
