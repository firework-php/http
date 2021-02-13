<?php

namespace Http;

class Http
{
    private $url;
    private $headers = [];
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
     * @return $this
     */
    public function setUrl(string $url): Http
    {
        $this->url = $url;
        $this->curlSettings[CURLOPT_URL] = $this->url;

        return $this;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers): Http
    {
        if (gettype($headers) == "array") {
            $this->headers = array_merge($this->headers, $headers);
            $this->curlSettings = $this->headers;
        }

        return $this;
    }


    /**
     * @param array $settings
     * @return $this
     */
    public function setCurlSettings(array $settings): Http
    {
        $this->curlSettings = array_merge($this->curlSettings, $settings);

        return $this;
    }

    /**
     * @param $settings
     * @return $this
     */
    public function removeCurlSettings($settings): Http
    {
        if (gettype($settings) == "array") {
            for ($i = 0; $i <= count($settings); $i++) {
                foreach ($this->curlSettings as $key => $item) {
                    if ($item == $settings[$i]) {
                        unset($this->curlSettings[$key]);
                    }
                }
            }
        } else {
            foreach ($this->curlSettings as $key => $item) {
                if ($item == $settings) {
                    unset($this->curlSettings[$key]);
                }
            }
        }

        return $this;
    }

    /**
     * @return mixed|string
     */
    public function getResponseCode(): string
    {
        $curl = curl_init();

        curl_setopt_array($curl, $this->curlSettings);

        $response = curl_exec($curl);
        $response = explode(' ', $response);

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

    /**
     * @param array $arr
     * @return string
     */
    public function put(array $arr): string
    {
        $curl = curl_init();

        array_merge($this->curlSettings, [
           CURLOPT_CUSTOMREQUEST => 'PUT',
           CURLOPT_POSTFIELDS => http_build_query($arr),
        ]);

        curl_setopt_array($curl, $this->curlSettings);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    /**
     * @param array $arr
     * @return string
     */
    public function delete(array $arr): string
    {
        $curl = curl_init();

        array_merge($this->curlSettings, [
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_POSTFIELDS => http_build_query($arr),
        ]);

        curl_setopt_array($curl, $this->curlSettings);

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}