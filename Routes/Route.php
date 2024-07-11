<?php
require_once ('../sphere_kit/kernel/error_handler.php');

$routes = [
    '/' => 'homeAction',
];

function homeAction(){
    ViewRender("welcome.php");
}

CORS_ALLOWED_ORIGIN(['127.0.0.1']);

Route($routes);

?>

