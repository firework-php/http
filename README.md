# Firework PHP : HTTP Client

## Basic usage

    <?php

    use Http\Http; // Import main class
    require __DIR__ . 'path-to-autoload'; // Import composer autoload 

    $http = new Http; // Create new Http class
    $http->url("https://httpbin.org/post"); // Add HTTP url

    // Print headers of the request
    print_r(
        $http->get_headers()
    );

    // Print body of the request
    print_r(
        $http->get_body() 
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
    