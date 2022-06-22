<?php
class ItemModel extends Database
{
  function fetch_all(?int $user_id, ?string $status): ?array
  {
    $query = "select 
    items.*, 
    users.username as author_name,
    users.photo as author_photo,
    users.phone as author_phone,
    categories.category,
    cities.city
    from items 
    join users on author_id = users.id 
    join categories on category_id = categories.id 
    join cities on city_id = cities.id
    ";
    $params = [];
    if ($user_id) {
      $query .= ' where author_id = ?';
      $params[] = $user_id;
    }
    if ($status) {
      $query .= $user_id ? ' and status = ?' : ' where status = ?';
      $params[] = $status;
    }
    return $this->execStatement($query, $params)->fetch_all(MYSQLI_ASSOC);
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

  function get_last_inserted_item(): array
  {
    $query = 'select * from items where id = (select last_insert_id())';
    return $this->execStatement($query)->fetch_assoc();
  }

  function delete(int $id): void
  {
    $query = "delete from items where id = ?";
    $params = array($id);
    $this->execStatement($query, $params);
  }

  function store_item_image(int $id, string $image): void
  {
    $query = "insert into items_images (image, item_id) values(?, ?)";
    $params = array($image, $id);
    $this->execStatement($query, $params);
  }

  function get_item_images(int $id): array
  {
    $query = 'select image, id from items_images where item_id = ?';
    $params = array($id);
    return $this->execStatement($query, $params)->fetch_all(MYSQLI_ASSOC);
  }

  function create(array $data): void
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

  function reserve(array $data): void
  {
    $query = 'insert into reserved_items 
    (item_id, user_id, take_at, description) 
    values (?, ?, ?, ?) 
    ';
    $params = array($data['item_id'], $data['user_id'], $data['take_at'], $data['description']);
    $this->execStatement($query, $params);
  }

  function get_saved_item(int $item_id, int $user_id): array|null
  {
    $query = 'select * from saved_items where item_id = ? and user_id = ?';
    $params =  array($item_id, $user_id);
    return $this->execStatement($query, $params)->fetch_assoc();
  }

  function save(int $user_id, int $item_id)
  {
    $query = 'insert into saved_items 
    (item_id, user_id) 
    values (?, ?) 
    ';
    $params = array($item_id, $user_id);
    $this->execStatement($query, $params);
  }
  function fetch_all_saved(int $user_id)
  {
    $query = 'select
    items.*, 
    users.username as author_name, 
    categories.category, 
    cities.city 
    from saved_items 
    join items on item_id = items.id 
    join users on author_id = users.id 
    join categories on category_id = categories.id  
    join cities on city_id = cities.id 
    where user_id = ?';
    $params = array($user_id);
    return $this->execStatement($query, $params)->fetch_all(MYSQLI_ASSOC);
  }

  function fetch_reserved(int $user_id)
  {
    $query = 'select
    items.*, 
    users.username as author_name, 
    categories.category, 
    cities.city ,
    reserved_items.status as reserve_status
    from reserved_items 
    join items on item_id = items.id 
    join users on author_id = users.id 
    join categories on category_id = categories.id  
    join cities on city_id = cities.id 
    where reserved_items.user_id = ?';
    $params = array($user_id);
    return $this->execStatement($query, $params)->fetch_all(MYSQLI_ASSOC);
  }

  function fetch_all_reserved(int $user_id, string $status, bool $author = false): array
  {
    $query = 'select
    items.*, 
    auths.username as author_name, 
    categories.category, 
    cities.city ,
    reservers.id as reserver_id,
    reservers.username as reserver_name,
    reserved_items.created_at as reserved_at,
    reserved_items.description as reserve_description
    from reserved_items 
    join items on item_id = items.id 
    join users auths on author_id = auths.id 
    join categories on category_id = categories.id  
    join cities on city_id = cities.id 
    join users reservers on reserved_items.user_id = reservers.id where';
    $query .= $author ? ' auths.id = ?' : ' reserved_items.user_id = ?';
    $params = [$user_id];
    if ($status) {
      $query .= ' and reserved_items.status = ?';
      $params[] = $status;
    }
    return $this->execStatement($query, $params)->fetch_all(MYSQLI_ASSOC);
  }

  function update_reservation(int $item_id, bool $is_accepted)
  {
    $status = $is_accepted ? 'accepted' : 'rejected';
    $query = 'update reserved_items set status = ? where item_id = ?';
    $params = array($status, $item_id);
    $this->execStatement($query, $params);
  }

  function update(array $data)
  {
    $query = 'update items set
    title = ?, 
    description = ?,
    city_id = (select id from cities where city = ?),
    category_id = (select id from categories where category = ?),
    address = ? 
    where id = ?
    ';
    $params = array(
      $data['title'],
      $data['description'],
      $data['city'],
      $data['category'],
      $data['address'],
      $data['id']
    );
    $this->execStatement($query, $params);
  }

  function fetch_full_item(int $item_id)
  {
    $query = 'select
    items.*, 
    users.username as author_name, 
    users.photo as author_photo,
    users.phone as author_phone,
    categories.category, 
    cities.city
    from items 
    join users on author_id = users.id 
    join cities on city_id = cities.id 
    join categories on category_id = categories.id  
    where items.id = ?';
    $params = array($item_id);
    return $this->execStatement($query, $params)->fetch_assoc();
  }
  function fetch_reserved_item(int $item_id)
  {
    $query = "select users.id as reserver_id, users.username as reserver_name, reserved_items.created_at as reserved_at, reserved_items.description as reserve_description from reserved_items join users on reserved_items.user_id = users.id join items on item_id = items.id where items.id=? ";
    $params = array($item_id);
    return $this->execStatement($query, $params)->fetch_assoc();
  }

  function check_is_save(int $item_id, int $user_id)
  {
    $query = "select 'saved' from saved_items where item_id = ? and user_id =  ?";
    $params = array($item_id, $user_id);
    return $this->execStatement($query, $params)->fetch_assoc();
  }

  function approve_or_refuse_item(int $item_id, string $status)
  {
    $query = "update items set items.status = ? where items.id = ?";
    $params = array($status, $item_id);
    $this->execStatement($query, $params);
  }
}
