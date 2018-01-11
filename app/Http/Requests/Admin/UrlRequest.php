<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\Models\Url;
use Illuminate\Validation\Rule;

class UrlRequest extends Request
{
    public function rules()
    {
        $rules = [
            'url' => 'required',
            'redirect_url' => 'required',
        ];

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
        $this->validateUrlUnique();
    }

    public function validateUrlUnique()
    {
        $domain = $this->route('domain');
        $url = $this->get('url');

        $urlExists = Url::where('domain_id', $domain->getKey())
            ->where('url', $url)
            ->exists();

        if ($urlExists) {
            $this->failed("$domain 域名下已存在 $url");
        }
    }
}
