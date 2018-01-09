@extends('admin.layouts.main')

@section('title')
  用户管理
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <div class="box-tools">
            <a href="{{ route('admin.rbac.user.create') }}" class="btn btn-primary">新增用户</a>
          </div>
        </div>

        <div class="box-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>用户名</th>
                <th>Email</th>
                <th>角色</th>
                <th>日期</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $user)
                <tr>
                  <td>{{ $user->id }}.</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    @foreach($user->roles as $role)
                      {{ $role->display_name }}
                    @endforeach
                  </td>
                  <td>{{ $user->created_at }}</td>
                  <td>
                    <a href="{{ route('admin.rbac.user.edit', ['id' => $user->id]) }}" class="btn btn-info">编辑</a>
                    <button class="btn btn-danger" action="destroy"
                            data-href="{{ route('admin.rbac.user.destroy', ['id' => $user->id]) }}">删除</button>
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


