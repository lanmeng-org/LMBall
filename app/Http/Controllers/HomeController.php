<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\RedirectLog;
use App\Models\Url;
use Illuminate\Http\Request;
use Lanmeng\Utils\IPUtil;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $host = $request->getHttpHost();
        $path = $request->getPathInfo();

        $mainDomain = $this->takeMainDomain($host);
        $domain = Domain::where('name', $mainDomain)->first();
        if (empty($domain)) {
            abort(404);
        }

        $url = Url::where('domain_id', $domain->getKey())
            ->where('url', $path)
            ->first();
        if (empty($url)) {
            abort(404);
        }

        $clientIp = $request->ip();
        RedirectLog::create([
            'domain_id'       => $domain->getKey(),
            'url_id'          => $url->getKey(),
            'client_ip'       => $clientIp,
            'client_position' => IPUtil::ip2Position($clientIp),
        ]);

        return redirect($url->redirect_url);
    }

    protected function takeMainDomain($host)
    {
        $suffixes = config('product.domain_suffixes');

        foreach ($suffixes as $suffix) {
            $suffix = '/.+\.([^\.]+' . str_replace('.', '\.', $suffix) . '$)/';

            if (preg_match($suffix, $host)) {
                return preg_replace($suffix, '$1', $host);
            };
        }

        return null;
    }
}
