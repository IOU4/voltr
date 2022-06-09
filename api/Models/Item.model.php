<?php
class ItemModel extends Database
{
  function fetch_all(): ?array
  {
    $query = "select 
    items.*, 
    users.username as author_name,
    categories.category,
    cities.city
    from items 
    join users on author_id = users.id 
    join categories on category_id = categories.id 
    join cities on city_id = cities.id
    order by id ";
    $res = $this->execStatement($query);
    return $res->fetch_all(MYSQLI_ASSOC);
  }

  function get_item_by_id(int $id): ?array
  {
    $query = "select 
    items.*, 
    users.username as author_name,
    categories.category,
    cities.city
    from items 
    join users on author_id = users.id 
    join categories on category_id = categories.id 
    join cities on city_id = cities.id
    where items.id = ?";
    $params = [$id];
    $res = $this->execStatement($query, $params)->fetch_assoc();
    return $res;
  }

  function get_last_inserted_item()
  {
    $query = 'select * from items where id = (select last_insert_id())';
    return $this->execStatement($query)->fetch_assoc();
  }

  function delete(int $id)
  {
    $query = "delete from items where id = ?";
    $params = array($id);
    $this->execStatement($query, $params);
  }

  function store_item_image(int $id, string $image)
  {
    $query = "insert into items_images (image, item_id) values(?, ?)";
    $params = array($image, $id);
    $this->execStatement($query, $params);
  }

  function get_item_images($id)
  {
    $query = 'select image, id from items_images where item_id = ?';
    $params = array($id);
    return $this->execStatement($query, $params)->fetch_all(MYSQLI_ASSOC);
  }

  function create($data)
  {
    $query = 'insert into items 
    (title, description, cover, category_id, city_id, address, author_id) 
    values( ?, ?, ?, (select id from categories where category = ?), (select id from cities where city = ?), ?, ?)';
    $params = array(
      $data['title'],
      $data['description'],
      $data['cover'],
      $data['category'],
      $data['city'],
      $data['address'],
      $data['author_id']
    );
    $this->execStatement($query, $params);
  }
}
