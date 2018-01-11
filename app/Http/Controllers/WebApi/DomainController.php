<?php

namespace App\Http\Controllers\WebApi;

use App\Models\Domain;

class DomainController extends Controller
{
    public function show(Domain $domain)
    {
        $selectField = 'client_country, count(client_country) as count_country, 
            client_city, count(client_city) as count_city, 
            client_region, count(client_region) as count_region, 
            client_isp, count(client_isp) as count_isp, 
            client_browser, count(client_browser) as count_browser, 
            client_os, count(client_os) as count_os, 
            referer_domain, count(referer_domain) as count_domain, 
        ';

        $data = \DB::table('redirect_logs')
            ->groupBy(['client_country'])
            ->selectRaw($selectField)
            ->get();

        return $this->jsonResponse->success200($data);
    }
}
