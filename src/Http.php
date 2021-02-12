<?php

namespace Http;

class Http
{
    private $url;
    private $headers;

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return file_get_contents($this->url);
    }

    /**
     * @return bool|string
     */
    public function getHeaders(): string
    {
        $curl = curl_init();

        curl_setopt($curl,CURLOPT_URL, $this->url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_NOBODY,true);
        curl_setopt($curl,CURLOPT_HEADER,true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    /**
     * @param array $arr
     * @return bool|string
     */
    public function post(array $arr): string
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($arr));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}