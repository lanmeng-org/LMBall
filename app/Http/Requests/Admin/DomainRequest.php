<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class DomainRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required',
            'weight' => 'required|integer',
        ];
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
