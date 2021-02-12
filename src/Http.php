<?php

namespace Http;

class Http
{
    private $url;

    public function url(string $url)
    {
        $this->url = $url;
    }

    public function get_body()
    {
        return file_get_contents($this->url);
    }

    public function get_headers()
    {
        $curl = curl_init();

        curl_setopt($curl,CURLOPT_URL, $this->url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_NOBODY,true);
        curl_setopt($curl,CURLOPT_HEADER,true);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function post(array $arr)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($arr));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}