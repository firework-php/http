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
$url = url of the request : "http://example.com/"

    $http->setUrl($url);

### setHeaders()
Set headers of the request \
Params: \
$arr = array of headers : ["HeaderName:HeaderValue", "HeaderName2:HeaderValue2"]

    $http->setHeaders($arr);

### getHeaders()
Return headers of the request
    
    $http->getHeaders(); 

### getBody()
Return body of the request

    $http->getbody();

### post()
Send post request to url \
Params: \
$arr = array of request values : ["name": "john", "age": 25]

    $http->post($arr);
