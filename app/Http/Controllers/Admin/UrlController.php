<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UrlRequest;
use App\Models\Domain;
use App\Models\Url;

class UrlController extends Controller
{
    public function index(Domain $domain)
    {
        $urls = Url::where('domain_id', $domain->getKey())
            ->paginate(20);

        return view('admin.url.index', [
            'domain' => $domain,
            'urls' => $urls,
        ]);
    }

    public function create(Domain $domain)
    {
        return view('admin.url.form', [
            'domain' => $domain,
        ]);
    }

    public function edit(Domain $domain, Url $url)
    {
        return view('admin.url.form', [
            'domain' => $domain,
            'url' => $url,
        ]);
    }

    public function store(Domain $domain, UrlRequest $request)
    {
        $data = $request->all();
        $data['domain_id'] = $domain->getKey();

        Url::create($data);
        session()->flash('tips.success', $request->get('url'). ' 添加成功');

        return redirect()->route('admin.url.index', ['domain' => $domain->getKey()]);
    }

    public function update(Domain $domain, Url $url, UrlRequest $request)
    {
        $data = $request->all();
        $data['domain_id'] = $domain->getKey();

        $url->update($data);
        session()->flash('tips.success', $request->get('url'). ' 更新成功');

        return redirect()->route('admin.url.index', ['domain' => $domain->getKey()]);
    }

    public function show(Domain $domain, Url $url)
    {
        return view('admin.domain.show', [
            'domain' => $domain,
            'url' => $url,
        ]);
    }

    public function destroy(Domain $domain, Url $url)
    {
        $url->delete();

        return redirect()->route('admin.url.index', ['domain' => $domain->getKey()]);
    }
}
