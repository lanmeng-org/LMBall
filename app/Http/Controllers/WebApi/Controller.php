<?php
namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller as BaseController;
use Lanmeng\Responses\Api\JsonResponse;

class Controller extends BaseController
{
    protected $jsonResponse;

    public function __construct(JsonResponse $jsonResponse)
    {
        $this->jsonResponse = $jsonResponse;
    }
}
