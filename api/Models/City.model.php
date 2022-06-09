<?php
class CityModel extends Database
{
  function fetch_all()
  {
    $query = 'select * from cities';
    $res = $this->execStatement($query);
    return $res->fetch_all(MYSQLI_ASSOC);
  }

  function get_city_by_id(int $id)
  {
    $query = "select * from cities where id = ?";
    $params = [$id];
    $res = $this->execStatement($query, $params)->fetch_assoc();
    return $res;
  }
}
