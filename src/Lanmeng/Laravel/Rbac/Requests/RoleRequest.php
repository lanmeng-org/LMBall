<?php
namespace Lanmeng\Laravel\Rbac\Requests;

class RoleRequest extends Request
{
    public function rules()
    {
        $rules = [
            'name' => 'required|unique:rbac_roles,name',
            'display_name' => 'required',
        ];

        if ($this->isMethod('put')) {
            $role = $this->route('role');

            $rules['name'] = 'required|unique:rbac_roles,name,'. $role->getKey();
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => '规则标识',
            'display_name' => '显示名称',
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
