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
        $domain = $this->getDomain($request);
        $url = $this->getUrl($domain, $request);

        // 记录访问记录
        $this->saveRedirectLog($domain, $url, $request);

        return redirect($url->redirect_url);
    }

    protected function getDomain(Request $request)
    {
        $mainDomain = $this->takeMainDomain($request->getHttpHost());
        if (empty($mainDomain)) {
            abort(404);
        }

        $domain = Domain::where('name', $mainDomain)->first();
        if (empty($domain)) {
            abort(404);
        }

        return $domain;
    }

    protected function getUrl(Domain $domain, Request $request)
    {
        $url = Url::where('domain_id', $domain->getKey())
            ->where('url', $request->getRequestUri())
            ->first();

        if (empty($url)) {
            abort(404);
        }

        return $url;
    }

    /**
     * @param $host
     * @return null|string|string[]
     */
    protected function takeMainDomain($host)
    {
        $suffixes = config('product.domain_suffixes');
        foreach ($suffixes as $suffix) {
            $suffixPreg = '/(.+\.)*([^\.]+' . str_replace('.', '\.', $suffix) . '$)/';

            if (preg_match($suffixPreg, $host)) {
                return preg_replace($suffixPreg, '$2', $host);
            };
        }

        return null;
    }

    /**
     * @param Domain  $domain
     * @param Url     $url
     * @param Request $request
     */
    protected function saveRedirectLog(Domain $domain, Url $url, Request $request)
    {
        $ip = $request->ip();

        $data = [
            'domain_id'                 => $domain->getKey(),
            'url_id'                    => $url->getKey(),
            'client_ip'                 => sprintf('%u', ip2long($ip)),
            'client_browser_user_agent' => $request->userAgent(),
            'referer_url'               => $request->headers->get('Referer'),
        ];
        RedirectLog::create($data);
    }
}
