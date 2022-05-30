<?php
class ItemModel extends Database
{
  function fetch_all()
  {
    $query = 'select * from items';
    $res = $this->execStatement($query);
    return $res->fetch_all(MYSQLI_ASSOC);
  }

  function get_item_by_id(int $id)
  {
    $query = "select * from items where id = ?";
    $params = [$id];
    $res = $this->execStatement($query, $params)->fetch_assoc();
    return $res;
  }
}
