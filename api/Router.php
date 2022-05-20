<?php

class Router
{
  private $method;
  private $uri;

  public function __construct()
  {
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->uri = $_SERVER['REQUEST_URI'];
  }

  public function get(string $route, callable $callable)
  {
    $parsed_url = parse_url($this->uri);
    $query = [];
    if (isset($parsed_url['query'])) {
      parse_str($parsed_url['query'], $query);
    }
    if ('/api' . $route == $parsed_url['path'] && $this->method == 'GET') {
      call_user_func($callable, $query);
      die();
    }
  }

  public function post(string $route, callable $callable)
  {
    $path = parse_url($this->uri)['path'];
    if ('/api' . $route == $path && $this->method == 'POST') {
      $data = empty($_POST) ? json_decode(file_get_contents('php://input'), true) : $_POST;
      call_user_func($callable, $data);
      die();
    }
  }

  public function patch(string $route, callable $callable)
  {
    $path = parse_url($this->uri)['path'];
    if ('/api/patch' . $route == $path && $this->method == 'POST') {
      $data = json_decode(file_get_contents('php://input'));
      call_user_func($callable, $data);
      die();
    }
  }

  public function delete(string $route, callable $callable)
  {
    $path = parse_url($this->uri)['path'];
    if ('/api/delete' . $route == $path && $this->method == 'POST') {
      $data = json_decode(file_get_contents('php://input'));
      call_user_func($callable, $data);
      die();
    }
  }
}
