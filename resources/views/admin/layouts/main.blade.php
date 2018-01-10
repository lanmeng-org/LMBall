@extends('layouts.html')

@section('styles')
  @yield('before_styles')
  @parent
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/admin-lte/css/AdminLTE.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/admin-lte/css/skins/skin-black-light.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @yield('after_styles')
@endsection

@section('body-class')
  hold-transition skin-black-light sidebar-mini
@endsection

@section('body')
  <div class="wrapper">
    @include('admin.layouts._header')

    @include('admin.layouts._sidebar')

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          @yield('title')
          <small>@yield('subTitle')</small>
        </h1>
      </section>

      <section class="content">
        @yield('content')
      </section>
    </div>

    @include('admin.layouts._footer')
  </div>
@endsection

@section('layers')
  <div class="modal resource-destroy">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">提示</h4>
        </div>
        <div class="modal-body">
          <p>你确定要删除吗?</p>
        </div>
        <div class="modal-footer">
          {{ Form::open(['method' => 'DELETE', 'class' => 'destroy-form']) }}
          <button type="button" class="btn btn-info" data-dismiss="modal">取消</button>
          <button type="submit" class="btn btn-danger">确定</button>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  @yield('before_scripts')
  @parent

  <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendor/admin-lte/js/app.min.js') }}"></script>

  <script>
    $(function () {

      var current_url = "{{ request()->fullUrl() }}";
      $("ul.sidebar-menu li a").each(function() {
        if (current_url.startsWith($(this).attr('href')))
        {
          $(this).parents('li').addClass('active');
        }
      });

      $('button[data-action=destroy]').click(function () {
        var $resourceDestroyBox = $('.resource-destroy');
        $resourceDestroyBox.find('.destroy-form').attr('action', $(this).attr('data-href'));
        $resourceDestroyBox.modal();
      });
    });
  </script>
  @yield('after_scripts')
@endsection
