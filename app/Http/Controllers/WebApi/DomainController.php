<?php

namespace App\Http\Controllers\WebApi;

use App\Models\Domain;

class DomainController extends Controller
{
    public function show(Domain $domain)
    {
        $data = [
            'count' => \DB::table('redirect_logs')
                ->where('domain_id', $domain->getKey())
                ->count(),
        ];
        $fields = [
            'client_country' => 'count_country',
            'client_region'  => 'count_region',
            'client_isp'     => 'count_isp',
            'client_browser' => 'count_browser',
            'client_os'      => 'count_os',
        ];

        // 统计信息
        foreach ($fields as $key => $field) {
            $data[$key] = \DB::table('redirect_logs')
                ->where('domain_id', $domain->getKey())
                ->whereNotNull($key)
                ->groupBy([$key])
                ->selectRaw("$key, count($key) as $field")
                ->get();
        }

        return $this->jsonResponse->success200($data);
    }
}
