
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">URL排行</h3>
    <div class="box-tools pull-right"></div>
  </div>
  <div class="box-body">
    <table class="table table-bordered table-td-middle">
      <thead>
      <tr>
        <th>URL</th>
        <th>简介</th>
        <th style="width: 60px;">访问</th>
      </tr>
      </thead>
      <tbody>
      @foreach($urlTop as $url)
        <tr>
          <td>{{ $url->url }}</td>
          <td>{{ $url->description }}</td>
          <td>{{ $url->count_url }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
