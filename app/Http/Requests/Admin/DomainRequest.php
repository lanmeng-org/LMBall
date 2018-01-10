<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class DomainRequest extends Request
{
    public function rules()
    {
        $rules = [
            'name' => 'required|unique:domains,name',
            'weight' => 'required|integer',
        ];

        $domain = $this->route('domain');
        if ($domain) {
            $rules['name'] = [
                'required',
                Rule::unique('domains')->ignore($domain->getKey()),
            ];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => '域名',
            'description' => '简介',
            'weight' => '排序',
        ];
    }

    public function validate()
    {
        $this->rulesValidate();
    }
}
