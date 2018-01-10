<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UrlRequest extends Request
{
    public function rules()
    {
        $rules = [
            'url' => 'required|unique:urls,url',
            'redirect_url' => 'required',
        ];

        $url = $this->route('url');
        if ($url) {
            $rules['url'] = [
                'required',
                Rule::unique('urls')->ignore($url->getKey()),
            ];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'url' => 'URL地址',
            'redirect_url' => '跳转地址',
            'description' => '简介',
        ];
    }

    public function validate()
    {
        $this->rulesValidate();
    }
}
