<?php

namespace App;

use Psr\Http\Message\ResponseInterface;

interface ConsumesExternalInterface
{
    public function makeRequest(
        $method, 
        $requestUrl, 
        $queryParams = [], 
        $formParams = [], 
        $headers = [], 
        $isJsonRequest = false
    ): ResponseInterface;
}
