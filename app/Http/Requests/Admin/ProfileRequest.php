<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class ProfileRequest extends Request
{
    public function rules()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
        ];

        if ($this->has('password')) {
            $rules['password'] = 'min:6';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => '姓名',
            'email' => '邮箱',
            'password' => '密码',
        ];
    }

    public function validate()
    {
        $this->rulesValidate();
    }
}
