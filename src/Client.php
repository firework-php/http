<?php

namespace Http;

use Http\Response;

class Client
{
    public $headers = [];
    public $curlSettings = [];

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
     * @param string $customRequest
     * @param array $arr
     * @return string
     */
    public function curlRequest(string $customRequest, array $arr, bool $noBody): string
    {
        $curl = curl_init();

        $this->curlSettings = array_merge($this->curlSettings, [
           CURLOPT_CUSTOMREQUEST => $customRequest,
           CURLOPT_POSTFIELDS => http_build_query($arr),
           CURLOPT_NOBODY => $noBody,
        ]);

        curl_setopt_array($curl, $this->curlSettings);

        $response = curl_exec($curl);
        curl_close($curl);

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
     * @return void
     */
    public function getHeaders(): void
    {
        $this->curlRequest("GET", [], true);
    }

    /**
     * @param array $settingsArr
     * @param bool $noBody
     * @return void
     */
    public function get(array $settingsArr, bool $noBody): void
    {
        $this->curlRequest("GET", $settingsArr, $noBody);
    }

    /**
     * @param array $settingsArr
     * @param bool $noBody
     * @return void
     */
    public function post(array $settingsArr, bool $noBody): void
    {
        $this->curlRequest("POST", $settingsArr, $noBody);
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