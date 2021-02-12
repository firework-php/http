<?php

namespace Http;

class Http
{
    private $url;
    private $headers;
    private $curlSettings = [];

    /**
     * Http constructor.
     */
    public function __construct()
    {
        $this->curlSettings = [
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_NOBODY => true,
            CURLOPT_HEADER => true,
            CURLOPT_HTTPHEADER => $this->headers,
        ];
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
        $this->curlSettings[CURLOPT_URL] = $this->url;
    }

    /**
     * @param array $headers
     */
    public function setHeaders($headers): void
    {
        if (gettype($headers) == "string") {
            array_push($this->headers, $headers);
            $this->curlSettings = $this->headers;
        } else if (gettype($headers) == "array") {
            $this->headers = array_merge($this->headers, $headers);
            $this->curlSettings = $this->headers;
        }
    }

    /**
     * @param $headers
     */
    public function removeHeaders($headers): void
    {
        if (gettype($headers) == "string") {
            foreach ($this->headers as $key => $item) {
                if ($item == $headers) {
                    unset($this->headers[$key]);
                }
            }
        } else if (gettype($headers) == "array") {
            for ($i = 0; $i <= count($headers); $i++) {
                foreach ($this->headers as $key => $item) {
                    if ($item == $headers[$i]) {
                        unset($this->headers[$key]);
                    }
                }
            }
        }
    }

    /**
     * @param array $settings
     */
    public function setCurlSettings(array $settings): void
    {
        $this->curlSettings = array_merge($this->curlSettings, $settings);
    }

    /**
     * @param array $settings
     */
    public function removeCurlSettings(array $settings): void
    {
        if (gettype($settings) == "array") {
            for ($i = 0; $i <= count($settings); $i++) {
                foreach ($this->curlSettings as $key => $item) {
                    if ($item == $settings[$i]) {
                        unset($this->curlSettings[$key]);
                    }
                }
            }
        }
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

        curl_setopt_array($curl, $this->curlSettings);

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

        array_merge($this->curlSettings, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($arr),
        ]);

        curl_setopt_array($curl, $this->curlSettings);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}