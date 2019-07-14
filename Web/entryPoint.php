<?php
namespace Web;
class EntryPoint {
  private $routes;
  public function __construct(\App\Routes $routes) {
    $this->routes = $routes; //get routes
  }

  public function run() {
    $route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
    $routes = $this->routes->getRoutes();
    $method = $_SERVER['REQUEST_METHOD'];

    if (isset($routes[$route]['login'])) {
      $this->routes->checkLogin(); //check user is logged in
    }
    if (isset($routes[$route]['admin'])) {
      $this->routes->checkAdmin(); //check user is an admin
    }

    if (!isset($routes[$route][$method]['controller'])) {
      header('location: /'); //redirect to homepage if no controller set
    }

    $controller = $routes[$route][$method]['controller'];
    $functionName = $routes[$route][$method]['function'];
    $page = $controller->$functionName();
    $output = $this->loadTemplate('../templates/' . $page['template'], $page['variables']);
    $title = $page['title'];
    require '../templates/layout.html.php'; //get layout of all pages
  }

  public function loadTemplate($fileName, $templateVars) {
    extract($templateVars); //etract variables from controller
    ob_start();
    require $fileName; //get layout of contents
    $contents = ob_get_clean();
    return $contents; //return content with variables in
  }
}
