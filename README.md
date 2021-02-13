# Firework PHP : HTTP Client

## Basic usage

    <?php

    use Http\Http; // Import main class
    require __DIR__ . 'path-to-autoload'; // Import composer autoload 

    $http = new Http; // Create new Http class
    $http->setUrl("https://httpbin.org/post"); // Add HTTP url

    // Print headers of the request
    print_r(
        $http->getHeaders()
    );

    // Print body of the request
    print_r(
        $http->getBody() 
    );

    // Print response of the post request
    print_r(
        $http->post(
            [
                "name" => "jonn",
                "age" => 25
            ]
        )
    );

## Docs

### setUrl()
Set url of the request \
Params: \
$url = url of the request: 

    "http://example.com/"

&nbsp;

    $http->setUrl($url);

### setHeaders()
Set headers of the request \
Params: \
$headers = string or array of headers: 

    ["HeaderName:HeaderValue", "HeaderName2:HeaderValue2"] or "HeaderName:HeaderValue"

&nbsp;

    $http->setHeaders($headers);

### setCurlSettings()
Set curl settings of the request \
Params: \
$arr = array of settings: 

    [CURLOPT_URL => "http://example.com", CURLOPT_HEADER => false]

&nbsp;
    
    $http->setCurlSettings($arr);

### removeCurlSettings()
Remove curl settings of the request \
Params: \
$settings = string array of settings:

    [CURLOPT_POST, CURLOPT_HEADER] or CURLOPT_POST

&nbsp;

    $http->removeCurlSettings($settings);

### getHeaders()
Return headers of the request
    
    $http->getHeaders(); 

### getBody()
Return body of the request

    $http->getbody();

### get()
Send get request to url \
Params: \
$arr = array of request values:

    ["name" => "john", "age" => 25]

&nbsp;

    $http->get($arr);

### post()
Send post request to url \
Params: \
$arr = array of request values: 

    ["name" => "john", "age" => 25]

&nbsp;

    $http->post($arr);

### put()
Send put request to url \
Params: \
$arr = array of request values:

    ["name" => "john", "age" => 25]

&nbsp;

    $http->put($arr);

### delete()
Send delete request to url \
Params: \
$arr = array of request values:

    ["name" => "john", "age" => 25]

&nbsp;

    $http->delete($arr);

### patch()
Send patch request to url \
Params: \
$arr = array of request values:

    ["name" => "john", "age" => 25]

&nbsp;

    $http->patch($arr);

### isOk()
Return boolean

    $http->isOk();

### getResponseCode()
Return string of response code

    $http->getResponceCode();