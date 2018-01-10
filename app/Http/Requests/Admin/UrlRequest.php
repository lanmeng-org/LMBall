<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class UrlRequest extends Request
{
    public function rules()
    {
        return [
            'url' => 'required',
            'redirect_url' => 'required',
        ];
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
