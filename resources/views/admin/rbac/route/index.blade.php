@extends('admin.layouts.main')

@section('title')
  路由管理
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools">
            <a href="{{ route('admin.rbac.route.create') }}" class="btn btn-primary">新增路由</a>
          </div>
        </div>

        <div class="box-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>路由</th>
                <th>描述</th>
                <th>日期</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $item)
                <tr>
                  <td>{{ $item->id }}.</td>
                  <td>{{ $item->route }}</td>
                  <td>{{ $item->description }}</td>
                  <td>{{ $item->created_at }}</td>
                  <td>
                    <a href="{{ route('admin.rbac.route.edit', ['id' => $item->getKey()]) }}" class="btn btn-info">编辑</a>
                    <button class="btn btn-danger" action="destroy"
                            data-href="{{ route('admin.rbac.route.destroy', ['id' => $item->getKey()]) }}">删除</button>
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


