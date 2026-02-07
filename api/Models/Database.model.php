<?php
class Database
{
  protected $connection;

  function __construct()
  {
    $connection = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
    $this->connection = $connection;
  }

  function execStatement(string $query, array $params = [])
  {
    $stmnt = $this->connection->prepare($query);
    $stmnt->execute($params);
    $res =  $stmnt->get_result();
    if (!$res) return true;
    return $res;
  }
}
