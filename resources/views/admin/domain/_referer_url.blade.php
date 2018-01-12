<table class="table table-bordered table-td-middle" style="margin-bottom: 0;">
  <thead>
  <tr>
    <th>域名</th>
    <th style="width: 60px;">来量</th>
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
