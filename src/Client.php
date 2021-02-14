<?php

namespace Http;

class Client
{
    public array $headers = [];
    public array $curlSettings = [];

    /**
     * Http constructor.
     */
    public function __construct()
    {
        $this->curlSettings = [
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
        ];
    }

    /**
     * @param string $method
     * @param array $query
     * @param bool $isNeedBody
     * @return object
     */
    public function curlRequest(string $method, array $query, bool $isNeedBody): object
    {
        $curl = curl_init();

        $this->curlSettings = array_merge($this->curlSettings, [
           CURLOPT_CUSTOMREQUEST => $method,
           CURLOPT_POSTFIELDS => http_build_query($query),
           CURLOPT_NOBODY => $isNeedBody,
        ]);

        curl_setopt_array($curl, $this->curlSettings);

        $response = curl_exec($curl);
        curl_close($curl);

        print_r($response);

        return (new Response)->setResponse($response);
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): Client
    {
        $this->curlSettings = array_merge($this->curlSettings, [
            CURLOPT_URL => $url,
        ]);

        return $this;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers): Client
    {
        $this->headers = array_merge($this->headers, $headers);
        $this->curlSettings = $this->headers;

        return $this;
    }


    /**
     * @param array $settings
     * @return $this
     */
    public function setCurlSettings(array $settings): Client
    {
        $this->curlSettings = array_merge($this->curlSettings, $settings);

        return $this;
    }

    /**
     * @param array $settingsArr
     * @param bool $noBody
     * @return object
     */
    public function get(array $settingsArr, bool $noBody): object
    {
        return $this->curlRequest("GET", $settingsArr, $noBody);
    }

    /**
     * @param array $settingsArr
     * @param bool $noBody
     * @return object
     */
    public function post(array $settingsArr, bool $noBody): object
    {
        return $this->curlRequest("POST", $settingsArr, $noBody);
    }

    /**
     * @param array $settingsArr
     * @param bool $noBody
     * @return void
     */
    public function put(array $settingsArr, bool $noBody): void
    {
        $this->curlRequest("PUT", $settingsArr, $noBody);
    }

    /**
     * @param array $settingsArr
     * @param bool $noBody
     * @return void
     */
    public function delete(array $settingsArr, bool $noBody): void
    {
        $this->curlRequest("DELETE", $settingsArr, $noBody);
    }

    /**
     * @param array $settingsArr
     * @param bool $noBody
     * @return void
     */
    public function patch(array $settingsArr, bool $noBody): void
    {
        $this->curlRequest("PATCH", $settingsArr, $noBody);
    }
}