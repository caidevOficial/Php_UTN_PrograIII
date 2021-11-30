<?php



$firstMW = function (Request $request, RequestHandler $handler): ResponseMW {

    // Execute actions before invoke the next middleware
    $before = " in firstMW before the callable <br>";

    // Invoke the next middleware
    $response = $handler->handle($request);

    // Get the answer from the next middleware
    $apiContent = (string)$response->getBody();

    // Generate a new response
    $response = new ResponseMW();

    // Execute actions after invoke the next middleware
    $after = " in firstMW after the callable <br>";
    $response->getBody()->write('${$before} ${$apiContent} <br> ${$after}');
    return $response;
};

$app->put('/param/', function(Request $request, Response $response, array $args): Response{
    $response->getBody()->write('APT => PUT');
    return $response;
})->add($firstMW);

?>