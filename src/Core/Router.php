<?php
/**
 * Routeur simple pour l'application
 */

class Router {
    private $routes = [];

    public function get($path, $handler) {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler) {
        $this->addRoute('POST', $path, $handler);
    }

    public function put($path, $handler) {
        $this->addRoute('PUT', $path, $handler);
    }

    public function delete($path, $handler) {
        $this->addRoute('DELETE', $path, $handler);
    }

    private function addRoute($method, $path, $handler) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
            'pattern' => $this->convertPathToRegex($path),
        ];
    }

    private function convertPathToRegex($path) {
        // Convertir /article/:id en regex /article/([a-zA-Z0-9_-]+)
        $path = preg_replace('/:([a-zA-Z_][a-zA-Z0-9_]*)/', '(?P<$1>[a-zA-Z0-9_-]+)', $path);
        return '^' . $path . '$';
    }

    public function dispatch($url, $method = 'GET') {
        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (preg_match('#' . $route['pattern'] . '#', $url, $matches)) {
                // Filtrer les clés numériques (compatible versions PHP)
                $params = [];
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }
                
                $handler = $route['handler'];
                
                // Format: 'ControllerName@methodName'
                if (is_string($handler)) {
                    [$controller, $method] = explode('@', $handler);
                    $controllerClass = "App\\Controller\\$controller";
                    
                    if (!class_exists($controllerClass)) {
                        throw new Exception("Controller non trouvé: $controllerClass");
                    }
                    
                    $instance = new $controllerClass();
                    return $instance->$method(...array_values($params));
                }
                
                // Closure directe
                if (is_callable($handler)) {
                    return call_user_func_array($handler, array_values($params));
                }
            }
        }

        throw new Exception("Route non trouvée: $url");
    }

    public function getRoutes() {
        return $this->routes;
    }
}
?>
