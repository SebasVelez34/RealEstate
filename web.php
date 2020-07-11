<?php

include './Helpers/routes.php';

if(isset($_REQUEST)){
    $function   = $_REQUEST["f"];
    $routes     = new Routes;
    $controller = $routes->controller($_REQUEST["c"]);

    include "./controllers/{$controller}.php";
    $controller = new $controller;
    $response   = $controller->{$function}();

    var_dump($response);
}

?>