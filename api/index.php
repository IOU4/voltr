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
$app->get('/user/totals', 'User::totals');
$app->post('/login', 'User::login');
$app->post('/singup', 'User::singup');


// items
$app->get('/items', 'Item::all');
$app->get('/item', 'Item::fetch_full_item');
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
$app->post('/item/create', function ($data) {
  $item = new Item(null);
  $item->create($data);
});
$app->patch('/item', function ($data) {
  $item = new Item($data['id'] ?? null);
  $item->update($data);
});
$app->post('/item/reserve', function ($data) {
  $item = new Item($data['item_id'] ?? null);
  $item->reserve($data);
});
$app->post('/item/save', function ($data) {
  $item = new Item($data['item_id'] ?? null);
  $item->save($data['user_id']);
});
$app->get('/items/reserved', 'Item::fetch_reserved');
$app->post('/item/reject', fn ($data) => Item::update_reservation($data, false));
$app->post('/item/accept', fn ($data) => Item::update_reservation($data, true));
$app->post('/item/approve', function ($data) {
  $item = new Item($data['item'] ?? null);
  $item->approve_or_reject_item('active');
});
$app->post('/item/refuse', function ($data) {
  $item = new Item($data['item']);
  $item->approve_or_reject_item('refused');
});
$app->get('/items/saved', 'Item::fetch_all_saved');
$app->get('/items/all_reserved', 'Item::fetch_all_reserved');


// catergories
$app->get('/categories', 'Category::all');

// cities
$app->get('/cities', 'City::all');


http_response_code(400);
echo (json_encode('no matches found'));
session_unset();
session_destroy();
