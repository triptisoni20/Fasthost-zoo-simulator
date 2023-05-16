<?php

namespace src\router;

use src\controllers\IRequest;

class Router
{
    /**
     * @var IRequest
     */
    private IRequest $request;

    /**
     * @var array
     */
    private array $supportedHttpMethods = array(
        "GET",
        "POST"
    );

    private array $listOfAvailableRoutes = [];

    function __construct(IRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @param $name
     * @param $args
     *
     * @return void
     *
     * PHP magic method.
     *
     * This method is called when an undefined or inaccessible method is called on an object of this class
     * The method dynamically creates an associative array that map router to callbacks. We create one for each supported request method.
     * If an invalid method is called on the router object, we respond with a 405 Method Not Allowed.
     */
    function __call($name, $args)
    {
        list($route, $method) = $args;

        //add to array
        $this->listOfAvailableRoutes[] = $route;

        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    /**
     * @param $route
     *
     * @return string
     *
     * Removes trailing forward slashes from the right of the route
     */
    private function formatRoute($route): string
    {
        $result = rtrim($route, '/');
        if ($result === '') {
            return '/';
        }
        return $result;
    }

    private function invalidMethodHandler($requstMethod): void
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
        ob_start();
        include( "src/views/405.view.php");
        echo ob_get_clean();
    }

    private function defaultRequestHandler(): void
    {
        header("{$this->request->serverProtocol} 404 Not Found");
        ob_start();
        include( "src/views/404.view.php");
        echo ob_get_clean();
    }

    /**
     * @return void
     *
     * Resolves a route
     *
     * Selects a callback that gets called to handle a request based on the request’s HTTP method and path
     */
    function resolve(): void
    {
        //get the request method
        $requestMethod = $this->request->requestMethod;
        //get the formatted route
        $formatedRoute = $this->formatRoute($this->request->requestUri);

        //if the method is not supported, return 405
        if (!in_array(strtoupper($requestMethod), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler($requestMethod);
            return;
        }

        //if the route is not found, return 404
        if (!in_array($formatedRoute, $this->listOfAvailableRoutes)) {
            $this->defaultRequestHandler();
            return;
        }

        $methodDictionary = $this->{strtolower($requestMethod)};
        $method = $methodDictionary[$formatedRoute] ?? null;


        if (is_null($method)) {
            $this->defaultRequestHandler();
            return;
        }

        echo call_user_func_array($method, array($this->request));
    }

    function __destruct()
    {
        $this->resolve();
    }
}