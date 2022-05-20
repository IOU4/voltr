<?php
require_once 'loader.php';
$app = new Router();

$app->get('/', 'User::all');
$app->post('/', 'User::info');
$app->delete('/', 'User::all');
