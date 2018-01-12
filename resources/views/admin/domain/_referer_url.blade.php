<table class="table table-bordered table-td-middle">
  <thead>
  <tr>
    <th>域名</th>
    <th>来量</th>
  </tr>
  </thead>
  <tbody>
  @foreach($referer['url'] as $url)
    <tr>
      <td>{{ $url->referer_url }}</td>
      <td>{{ $url->count_url }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
