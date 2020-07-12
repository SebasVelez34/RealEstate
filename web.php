<?php

include './Helpers/Routes.php';
include './Helpers/Response.php';

if(isset($_REQUEST)){
    $function   = $_REQUEST["f"];
    $routes     = new Routes;
    $response   = new Response;
    $controller = $routes->controller($_REQUEST["c"]);

    include "./controllers/{$controller}.php";
    $controller = new $controller();
    try {
        $response = $controller->{$function}();
        echo json_encode($response["data"]);
    } catch (\Throwable $th) {
        echo json_encode([]);
    }
}

?>