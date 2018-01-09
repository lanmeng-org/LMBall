<?php
namespace Lanmeng\Laravel\Rbac\Requests;

class RouteRequest extends Request
{
    public function rules()
    {
        $rules = [
            'route' => 'required',
            'permissions' => 'required_without:roles|array',
            'roles' => 'required_without:permissions|array',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'route'     => '路由地址',
            'description' => '描述',
            'permissions'    => '权限码',
            'roles'    => '角色',
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

    public function validateRoutePreg()
    {
        try {
            preg_match("/{$this->get('route')}/", '');
        } catch (\Exception $err) {
            $this->failed('路由地址必需为正确的正则表达式');
        }
    }
}
