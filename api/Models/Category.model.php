<?php
class CategoryModel extends Database
{
  function fetch_all()
  {
    $query = 'select * from categories';
    $res = $this->execStatement($query);
    return $res->fetch_all(MYSQLI_ASSOC);
  }

  function get_category_by_id(int $id)
  {
    $query = "select * from categories where id = ?";
    $params = [$id];
    $res = $this->execStatement($query, $params)->fetch_assoc();
    return $res;
  }
}
