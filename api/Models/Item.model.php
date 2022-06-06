<?php
class ItemModel extends Database
{
  function fetch_all(): ?array
  {
    $query = "select 
    items.*, 
    users.username as author_name,
    categories.name as category
    from items 
    join users on author_id = users.id 
    join categories on category_id = categories.id ";
    $res = $this->execStatement($query);
    return $res->fetch_all(MYSQLI_ASSOC);
  }

  function get_item_by_id(int $id): ?array
  {
    $query = "select 
    items.*, 
    users.username as author_name,
    categories.name as category
    from items 
    join users on author_id = users.id 
    join categories on category_id = categories.id 
    where items.id = ?";
    $params = [$id];
    $res = $this->execStatement($query, $params)->fetch_assoc();
    return $res;
  }

  function delete(int $id)
  {
    $query = "delete from items where id = ?";
    $params = array($id);
    $this->execStatement($query, $params);
  }

  function store_item_image(int $id, string $name)
  {
    $query = "insert into items_images (name, item_id) values(?, ?)";
    $params = array($name, $id);
    $this->execStatement($query, $params);
  }

  function get_item_images($id)
  {
    $query = 'select name, id from items_images where item_id = ?';
    $params = array($id);
    return $this->execStatement($query, $params)->fetch_all(MYSQLI_ASSOC);
  }
}
