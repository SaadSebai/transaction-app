<?php

namespace App\Core;

use BadMethodCallException;
use Exception;
use InvalidArgumentException;
use JetBrains\PhpStorm\NoReturn;

/**
 * @method self get(string $uri, string $controller, string $method)
 * @method self post(string $uri, string $controller, string $method)
 * @method self put(string $uri, string $controller, string $method)
 * @method self patch(string $uri, string $controller, string $method)
 * @method self delete(string $uri, string $controller, string $method)
 */
class Router
{
    protected array $routes = [];
    protected $globalMiddlewares = [];

    protected array $methods = [
        'get', 'post', 'put', 'patch', 'delete'
    ];

    public function __construct()
    {
        $this->globalMiddlewares = array_keys((require base_path('config/middlewares.php'))['global']) ?? [];
    }

    public function __call(string $method, array $arguments)
    {
        if (!in_array(strtolower($method), $this->methods, true)) {
            throw new BadMethodCallException("Method $method is not supported.");
        }

        if (count($arguments) < 3) {
            throw new InvalidArgumentException("Method $method requires URI, controller, and function name.");
        }

        return $this->add(strtoupper($method), $arguments[0], $arguments[1], $arguments[2]);
    }

    public function add(string $method,string  $uri, string $controller, string $function): static
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'function' => $function,
            'method' => $method,
            'middleware' => []
        ];

        return $this;
    }

    public function middleware($key): static
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            $matches = [];

            if ($this->matchUri($route['uri'], $uri, $matches) && $route['method'] === strtoupper($method)) {

                array_shift($matches); // Remove the full match

                foreach ($this->globalMiddlewares as $middleware)
                {
                    Middleware::resolve($middleware, 'global');
                }

                foreach ($route['middleware'] as $middleware)
                {
                    Middleware::resolve($middleware);
                }
                return (new $route['controller'])->{$route['function']}(...$matches);
            }
        }

        abort();
    }

    public function previousUrl(): string
    {
        return $_SERVER['HTTP_REFERER'] ?? static::home();
    }

    private function matchUri(string $routeUri, string $requestUri, array &$matches): bool
    {
        $pattern = preg_replace('#\{(\w+)}#', '([\w-]+)', $routeUri);
        $pattern = "#^" . $pattern . "$#";

        return preg_match($pattern, $requestUri, $matches);
    }

    public static function home(): string
    {
        return Session::has('user') ? '/home' : '/';
    }
}
