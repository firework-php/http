<?php

namespace Http;
use Http\Client;

class Response
{
    public $response;

    /**
     * @param string $response
     * @return $this
     */
    public function setResponse(string $response): Response
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @return mixed|string
     */
    public function getResponseCode(): string
    {
        $response = explode(' ', $this->response);

        return $response[1];
    }

    /**
     * @return bool
     */
    public function isOk(): bool
    {
        if ($this->getResponseCode() == "200") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return file_get_contents((new Client)->curlSettings[CURLOPT_URL]);
    }
}