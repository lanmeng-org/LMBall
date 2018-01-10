<?php
namespace App\Http\Requests\WebApi;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Lanmeng\Responses\Api\JsonResponse;

class Request extends FormRequest
{
    protected function failed($msg, $code)
    {
        $jsonResponse = new JsonResponse();
        $params = [
            'msg' => $msg,
            'data' => null,
        ];
        $response = call_user_func_array([$jsonResponse, "error$code"], $params);

        throw new HttpResponseException($response);
    }

    protected function rulesValidate()
    {
        $validator = $this->getValidatorInstance();
        if ($validator->fails()) {
            $this->failed($validator->getMessageBag(), 400);
        }
    }
}
