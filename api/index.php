<?php
require_once 'loader.php';
$app = new Router();

$app->get('/', function () {
  echo json_encode('voltr api');
});

// users        ---
$app->get('/users', 'User::all');
$app->get('/user', function ($query) {
  if (empty($query['id'])) die(json_encode('no id'));
  $user = new User($query['id']);
  $user->get_user();
});
$app->post('/login', 'User::login');
$app->post('/singup', 'User::singup');
// $app->delete('/', 'User::all');
// $app->patch('/', 'User::all');


// items
$app->get('/items', 'Item::all');

die(json_encode('no matches found'));
