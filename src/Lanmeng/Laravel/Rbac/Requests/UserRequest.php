<?php
namespace Lanmeng\Laravel\Rbac\Requests;

class UserRequest extends Request
{
    public function rules()
    {
        $rules = [
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'roles' => 'array',
        ];

        if ($this->isMethod('put')) {
            $user = $this->route('user');

            $rules = [
                'name' => 'required|unique:users,name,'. $user->getKey(),
                'email' => 'required|unique:users,email,'. $user->getKey(),
                'roles' => 'array',
            ];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => '规则标识',
            'email' => '邮箱',
            'password' => '密码',
        ];
    }

    protected function rulesValidate()
    {
        $validator = $this->getValidatorInstance();
        if ($validator->fails()) {
            $this->failed($validator->getMessageBag()->first());
        }
    }

    public function validate()
    {
        $this->rulesValidate();
    }
}
