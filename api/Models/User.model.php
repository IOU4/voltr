<?php
class UserModel extends Database
{
  function fetch_all()
  {
    $query = 'select * from users';
    $res = $this->execStatement($query);
    return $res->fetch_all(MYSQLI_ASSOC);
  }

  function get_user_by_id(int $id)
  {
    $query = "select * from users where id = ?";
    $params = [$id];
    $res = $this->execStatement($query, $params)->fetch_assoc();
    return $res;
  }

  function get_user_by_email(string $email)
  {
    $query = 'select * from users where email = ?';
    $params = array($email);
    return $this->execStatement($query, $params)->fetch_assoc();
  }

  function add_user(array $data)
  {
    $query = 'insert into users (email, username, phone, password) values(?, ?, ?, ?)';
    $params = array(
      $data['email'],
      $data['username'],
      $data['phone'],
      $data['password']
    );
    return $this->execStatement($query, $params);
  }

  function get_last_inserted_user()
  {
    $query = 'select id, email, username, phone from users where id = (select last_insert_id())';
    return $this->execStatement($query)->fetch_assoc();
  }

  function delete(int $id)
  {
    $query = "delete from users where id = ?";
    $params = array($id);
    $this->execStatement($query, $params);
  }
}
