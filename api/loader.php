<?php
require_once './Router.php';
header('Content-Type: application/json');

spl_autoload_register(function ($class_name) {
  if (file_exists('Controllers/' . $class_name . '.controller.php'))
    include 'Controllers/' . $class_name . '.controller.php';
  if (file_exists('Models/' . $class_name . '.model.php'))
    include 'Models/' . $class_name . '.model.php';
});

session_start();
