<table class="table table-bordered table-td-middle">
  <thead>
  <tr>
    <th>域名</th>
    <th>来量</th>
  </tr>
  </thead>
  <tbody>
  @foreach($referer['domain'] as $domain)
    <tr>
      <td>{{ $domain->referer_domain }}</td>
      <td>{{ $domain->count_domain }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
