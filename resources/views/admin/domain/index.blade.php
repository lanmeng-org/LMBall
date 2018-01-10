@extends('admin.layouts.main')

@section('title')
  域名管理
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            <a href="{{ route('admin.domain.create') }}" class="btn btn-primary">新增域名</a>
          </h3>
          <div class="box-tools"></div>
        </div>

        <div class="box-body">
          <table class="table table-bordered table-td-middle">
            <thead>
              <tr>
                <th>域名</th>
                <th>简介</th>
                <th>添加日期</th>
                <th width="260">操作</th>
              </tr>
            </thead>
            <tbody>
              @foreach($domains as $domain)
                <tr>
                  <td>{{ $domain->name }}</td>
                  <td>{{ $domain->description }}</td>
                  <td>{{ $domain->created_at }}</td>
                  <td>
                    <a href="{{ route('admin.domain.show', ['id' => $domain->id]) }}" class="btn btn-primary">详情</a>
                    <a href="{{ route('admin.url.index', ['domain' => $domain->id]) }}" class="btn btn-info">URL</a>
                    <a href="{{ route('admin.domain.edit', ['id' => $domain->id]) }}" class="btn btn-warning">编辑</a>
                    <button class="btn btn-danger" data-action="destroy"
                            data-href="{{ route('admin.domain.destroy', ['id' => $domain->id]) }}">删除</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="box-footer clearfix">
          {{ $domains->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection


