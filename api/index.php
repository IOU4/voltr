<?php
require_once 'loader.php';
$app = new Router();

$app->get('/', function () {
  echo json_encode('voltr api');
});

// users
$app->get('/users', 'User::all');
$app->get('/user', function ($query) {
  $user = new User($query['id'] ?? null);
  $user->get_user();
});
$app->delete('/user', function ($data) {
  $user = new User($data['id'] ?? null);
  $user->delete();
});
$app->post('/login', 'User::login');
$app->post('/singup', 'User::singup');


// items
$app->get('/items', 'Item::all');
$app->delete('/item', function ($data) {
  $item = new Item($data['id'] ?? null);
  $item->delete();
});
$app->post('/item/images', function ($data) {
  $item = new Item($data['id'] ?? null);
  $item->store_item_images();
});
$app->get('/item/images', function ($query) {
  $item = new Item($query['id'] ?? null);
  $item->get_item_images();
});

exit(json_encode('no matches found'));
session_unset();
session_destroy();
