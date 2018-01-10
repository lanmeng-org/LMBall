@extends('admin.layouts.main')

@section('title')
  URL管理
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            <a href="{{ route('admin.domain.show', ['domain' => $domain->getKey()]) }}" class="btn btn-default">返回域名</a>
            <a href="{{ route('admin.url.create', ['domain' => $domain->getKey()]) }}" class="btn btn-primary">新增URL</a>
          </h3>
          <div class="box-tools"></div>
        </div>

        <div class="box-body">
          <table class="table table-bordered table-td-middle">
            <thead>
              <tr>
                <th>URL地址</th>
                <th>跳转地址</th>
                <th>简介</th>
                <th>添加日期</th>
                <th width="200">操作</th>
              </tr>
            </thead>
            <tbody>
              @foreach($urls as $url)
                <tr>
                  <td>{{ $url->url }}</td>
                  <td>{{ $url->redirect_url }}</td>
                  <td>{{ $url->description }}</td>
                  <td>{{ $url->created_at }}</td>
                  <td>
                    <a href="{{ route('admin.url.edit', ['domain' => $domain->getKey(), 'id' => $url->id]) }}"
                       class="btn btn-warning">编辑</a>
                    <button data-href="{{ route('admin.url.destroy', ['domain' => $domain->getKey(), 'id' => $url->id]) }}"
                            class="btn btn-danger" data-action="destroy" >删除</button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="box-footer clearfix">
          {{ $urls->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection


