<?php

class User
{
  private int|null $id;
  private string $name;
  private string $email;
  private string $password;
  private UserModel $model;

  public function __construct(string $name, string $email, $id = null)
  {
    $this->id = $id;
    $this->username = $name;
    $this->email = $email;
    $this->model = new UserModel();
  }

  public static function all()
  {
    $model = new UserModel();
    echo json_encode($model->fetch_all());
  }

  public static function info($data)
  {
    if (isset($data['hi'])) echo json_encode(['success' => true]);
    else echo json_encode('eroor');
  }
}
