@extends('admin.layouts.main')

@section('title')
  域名管理
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools">
            <a href="{{ route('admin.domain.create') }}" class="btn btn-primary">新增域名</a>
          </div>
        </div>

        <div class="box-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>域名</th>
                <th>简介</th>
                <th>日期</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $user)
                <tr>
                  <td>{{ $user->id }}.</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->description }}</td>
                  <td>{{ $user->created_at }}</td>
                  <td>
                    <a href="{{ route('admin.domain.edit', ['id' => $user->id]) }}" class="btn btn-info">编辑</a>
                    <button class="btn btn-danger" action="destroy"
                            data-href="{{ route('admin.domain.destroy', ['id' => $user->id]) }}">删除</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="box-footer clearfix">
          {{ $data->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection


