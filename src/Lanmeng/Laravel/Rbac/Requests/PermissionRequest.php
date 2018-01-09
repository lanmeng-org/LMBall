<?php
namespace Lanmeng\Laravel\Rbac\Requests;

class PermissionRequest extends Request
{
    public function rules()
    {
        $rules = [
            'name' => 'required|unique:rbac_permissions,name',
            'display_name' => 'required',
            'type' => 'required|in:0,1,2',
            'isMenu' => 'required|in:0,1',
        ];

        if ($this->isMethod('put')) {
            $rule = $this->route('rule');

            $rules['name'] .= ','. $rule->getKey();
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => '规则标识',
            'display_name' => '显示名称',
            'type' => '类型',
            'isMenu' => '是否显示为菜单',
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
