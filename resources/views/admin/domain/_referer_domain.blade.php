<table class="table table-bordered table-td-middle" style="margin-bottom: 0;">
  <thead>
  <tr>
    <th>域名</th>
    <th style="width: 60px;">来量</th>
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
