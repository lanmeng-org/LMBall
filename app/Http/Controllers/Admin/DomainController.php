<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\DomainRequest;
use App\Models\Domain;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::orderBy('weight')->paginate(20);

        return view('admin.domain.index', [
            'domains' => $domains,
        ]);
    }

    public function create()
    {
        return view('admin.domain.form');
    }

    public function edit(Domain $domain)
    {
        return view('admin.domain.form', [
            'data' => $domain,
        ]);
    }

    public function store(DomainRequest $request)
    {
        Domain::create($request->all());
        session()->flash('tips.success', $request->get('name'). ' 添加成功');

        return redirect()->route('admin.domain.index');
    }

    public function update(Domain $domain, DomainRequest $request)
    {
        $domain->update($request->all());
        session()->flash('tips.success', $request->get('name'). ' 更新成功');

        return redirect()->route('admin.domain.index');
    }

    public function show(Domain $domain)
    {
        $refererDomain = \DB::table('redirect_logs')
            ->where('domain_id', $domain->getKey())
            ->whereNotNull('referer_domain')
            ->orderByDesc('count_domain')
            ->groupBy(['referer_domain'])
            ->selectRaw("referer_domain, count(referer_domain) as count_domain")
            ->take(20)
            ->get();

        $refererUrl = \DB::table('redirect_logs')
            ->where('domain_id', $domain->getKey())
            ->whereNotNull('referer_url')
            ->orderByDesc('count_url')
            ->groupBy(['referer_url'])
            ->selectRaw("referer_url, count(referer_url) as count_url")
            ->take(20)
            ->get();

        $urlTop = \DB::table('redirect_logs')
            ->where('redirect_logs.domain_id', $domain->getKey())
            ->orderByDesc('count_url')
            ->groupBy(['url_id'])
            ->selectRaw("urls.url, url_id, count(url_id) as count_url")
            ->join('urls', 'urls.id', '=', 'redirect_logs.url_id')
            ->take(20)
            ->get();

        return view('admin.domain.show', [
            'domain' => $domain,
            'referer' => [
                'domain' => $refererDomain,
                'url' => $refererUrl,
            ],
            'urlTop' => $urlTop,
        ]);
    }

    public function destroy(Domain $domain)
    {
        $domain->delete();

        return redirect()->route('admin.domain.index');
    }
}
