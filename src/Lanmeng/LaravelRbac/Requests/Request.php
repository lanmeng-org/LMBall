<?php
namespace Lanmeng\LaravelRbac\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function failed($massage)
    {
        $response = \Redirect::back()->withInput($this->all())->withErrors($massage);

        throw new HttpResponseException($response);
    }
}
