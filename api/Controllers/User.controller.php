<?php

class User
{
  private ?int $id = null;
  private ?string $username;
  private ?string $email;
  // private ?string $password;
  private UserModel $model;

  public function __construct(?int $id = null)
  {
    $this->model = new UserModel();
    if (!$id) return;
    $db_data = $this->get_user_by_id($id);
    if (!$db_data) return;
    $this->id = $id;
    $this->username = $db_data['username'];
    $this->email = $db_data['email'];
    $this->phone = $db_data['phone'];
  }

  private function get_user_by_id(int $id)
  {
    try {
      $user_data = $this->model->get_user_by_id($id);
      return $user_data;
    } catch (Throwable $e) {
      echo json_encode($e->getMessage());
      return false;
    }
  }

  public function get_user()
  {
    if (!$this->id) die('id not found');
    $user_data = array(
      'username' => $this->username,
      'email' => $this->email,
      // 'phone' => $this->phone
    );
    echo json_encode($user_data);
  }

  public static function all()
  {
    $model = new UserModel();
    echo json_encode($model->fetch_all());
  }

  public static function login($data)
  {
    if (!isset($data['email'], $data['password'])) die(['logged' => false, 'error' => 'insufficient data']);
    $model = new UserModel();
    try {
      $user = $model->get_user_by_email($data['email']);
      if (!$user) die(json_encode(['logged' => false, 'error' => 'email not found']));
      if (!password_verify($data['password'], $user['password'])) die(json_encode(['logged' => false, 'error' => 'wrong password']));
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];
      unset($user['password']);
      echo json_encode(['logged' => true, 'user' => $user]);
    } catch (Exception $e) {
      echo json_encode(['logged' => false, 'error' => $e->getMessage()]);
    }
  }
  public static function singup($data)
  {
    if (!isset($data['email'], $data['phone'], $data['username'], $data['password'])) die(json_encode(['logged' => false, 'error' => 'no sufficient data']));
    $validated = array('email' => $data['email'], 'password' => password_hash($data['password'], PASSWORD_BCRYPT), 'phone' => $data['phone'], 'username' => $data['username']);
    $model = new UserModel();
    try {
      $user = $model->add_user($validated);
      if (!$user) die('error occured');
      $user = $model->get_last_inserted_user();
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];
      echo json_encode(['logged' => true, 'user' => $user]);
    } catch (Exception $e) {
      echo json_encode(['logged' => false, 'error' => $e->getMessage()]);
    }
  }

  public static function info($data)
  {
    if (isset($data['hi'])) echo json_encode(['success' => true]);
    else echo json_encode('eroor');
  }
}
