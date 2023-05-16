<?php


use src\controllers\Request;
use src\router\Router;

include_once ('src/router/Router.php');
include_once ('src/controllers/Request.php');
include_once ('src/utils/Cros.php');
include_once ('src/utils/Session.php');

/**
 * CORS
 */
cors();


/**
 * Home
 */
$router = new Router(new Request);

$router->get('/', function() {
    ob_start();
    include( "index.html");
    return ob_get_clean();
});

/**
 * Animals
 */
$router->get('/animals', function($request) {
    return json_encode($request->getAnimals());
});

/**
 * Current Time
 */
$router->get('/time', function($request) {
    return json_encode($request->getCurrentTime());
});

/**
 * Fast Forward Time
 */
$router->get('/fast-forward', function($request) {
    //call fastForwardTime function
    $request->fastForwardTime();
    //get time from session
    $time = $_SESSION['time'];
    //get animals from session
    $animals = $_SESSION['animals'];
    //combine time and animals
    $response = [
        'time' => $time,
        'animals' => $animals
    ];
    //return time
    return json_encode($response);
});
/**
 * Feed
 */
$router->get('/feed', function($request) {
    $request->feed();
    //get animals from session
    $animals = $_SESSION['animals'];
    //return animals
    return json_encode($animals);
});

