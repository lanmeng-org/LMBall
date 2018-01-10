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
        return view('admin.domain.show', [
            'domain' => $domain,
        ]);
    }

    public function destroy(Domain $domain)
    {
        $domain->delete();

        return redirect()->route('admin.domain.index');
    }
}
