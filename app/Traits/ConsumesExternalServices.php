<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

trait ConsumesExternalServices
{
    public function makeRequest(
        $method, 
        $requestUrl, 
        $queryParams = [], 
        $formParams = [], 
        $headers = [], 
        $isJsonRequest = false
    ): ResponseInterface
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (method_exists($this, 'resolveAuthorization')) {
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }

        $response = $client->request($method, $requestUrl, [
            $isJsonRequest ? 'json' : 'form_params' => $formParams,
            'headers' => $headers,
            'query' => $queryParams,
        ]);

        $response = $response->getBody()->getContents();

        if (method_exists($this, 'decodeResponse')) {
            $response = $this->decodeResponse($response);
        }

        return $response;
    }
}
