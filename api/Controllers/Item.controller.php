<?php

class Item
{
  private int $id;
  private string $title;
  private string $description;
  private ?int $author_id;
  private ?string $author_name;
  private ?string $cover;
  private string $category;
  private string $city;
  private string $address;
  private ItemModel $model;
  const ALLOWED_IMAGE_EXTENSIONS = ['png', 'jpeg', 'jpg', 'webp'];

  public function __construct(?int $id = null)
  {
    $this->model = new ItemModel();
    if (!$id) return;
    $db_data = $this->get_item_by_id($id);
    if (!$db_data) exit('no item found with this id');
    $this->id = $id;
    $this->title = $db_data['title'];
    $this->description = $db_data['description'];
    $this->author_id = $db_data['author_id'];
    $this->author_name = $db_data['author_name'];
    $this->cover = $db_data['cover'];
    $this->category = $db_data['category'];
    $this->city = $db_data['city'];
    $this->address = $db_data['address'];
  }

  private function get_item_by_id(int $id)
  {
    try {
      $user_data = $this->model->get_item_by_id($id);
      return $user_data;
    } catch (Throwable $e) {
      echo json_encode($e->getMessage());
      return false;
    }
  }

  public static function all($query)
  {
    $user_id = $status = null;
    if (!empty($query['user'])) $user_id = $query['user'];
    if (!empty($query['status'])) $status = $query['status'];
    $model = new ItemModel();
    try {
      $items = $model->fetch_all($user_id, $status);
      echo json_encode($items);
    } catch (Throwable $e) {
      echo json_encode($e->getMessage());
    }
  }

  public static function fetch_reserved($query)
  {
    $user_id = $status = null;
    $author = false;
    if (!empty($query['user'])) $user_id = $query['user'];
    if (!empty($query['status'])) $status = $query['status'];
    if (isset($query['author'])) $author = true;
    $model = new ItemModel();
    try {
      $items = $model->fetch_all_reserved($user_id, $status, $author);
      echo json_encode($items);
    } catch (Throwable $e) {
      echo json_encode($e->getMessage());
    }
  }

  public function delete()
  {
    try {
      if (empty($this->id)) throw new Exception('no id for delete');
      $this->model->delete($this->id);
      echo json_encode(['deleted' => true]);
    } catch (Throwable $e) {
      http_response_code(400);
      echo json_encode($e->getMessage());
    }
  }

  function store_item_images()
  {
    if (empty($this->id)) exit('no id');
    $names = array();
    foreach ($_FILES as $image) :
      $res = $this->store_single_image($image, false);
      if ($res) $names[] = $res;
    endforeach;
    echo json_encode(['stored' => true, 'names' => $names]);
  }

  function get_item_images()
  {
    if (empty($this->id)) exit('no id');
    try {
      $images = $this->model->get_item_images($this->id);
      echo  json_encode($images);
    } catch (Throwable $e) {
      echo json_encode($e->getMessage());
    }
  }

  public function create(array $data)
  {
    $this->validate_data($data);
    try {
      if (isset($_FILES['cover'])) $cover = $this->store_single_image($_FILES['cover'], true);
      $data['cover'] = $cover ?? null;
      $this->model->create($data);
      $item = $this->model->get_last_inserted_item();
      echo json_encode(['created' => true, 'item' => $item]);
    } catch (Throwable $th) {
      echo json_encode(['created' => false, 'error' => $th->getMessage()]);
    }
  }

  public function reserve($data)
  {
    try {
      if (!isset($data['take_at'], $data['user_id'], $this->id)) throw new Exception('no data');
      if (empty($data['description'])) $data['description'] = null;
      $item = $this->model->get_item_by_id($this->id);
      if ($item['status'] != 'active') throw new Exception('already reserved');
      if ($item['author_id'] == $data['user_id']) throw new Exception("can't reserve your own item");
      $this->model->reserve($data);
      echo json_encode(['reserved' => true, 'item' => $item]);
    } catch (Throwable $th) {
      echo json_encode(['reserved' => false, 'error' => $th->getMessage()]);
    }
  }

  public function save($user_id)
  {
    if (!isset($user_id, $this->id)) exit('no sufficant data');
    try {
      $item = $this->model->get_saved_item($this->id, $user_id);
      if ($item) {
        http_response_code(400);
        exit(json_encode(['reserved' => false, 'error' => 'already saved']));
      }
      $this->model->save($user_id, $this->id);
      $item = $this->model->get_saved_item($this->id, $user_id);
      echo json_encode(['reserved' => true, 'item' => $item]);
    } catch (Throwable $th) {
      http_response_code(400);
      echo json_encode(['reserved' => false, 'error' => $th->getMessage()]);
    }
  }

  public static function update_reservation(array $data, bool $is_accepted = true)
  {
    try {
      if (!isset($data['item_id'])) throw new Exception('no enough data provided');
      $model = new ItemModel();
      $model->update_reservation($data['item_id'], $is_accepted);
      echo (json_encode([$is_accepted ? 'accepted' : 'rejected' => true]));
    } catch (Throwable $th) {
      http_response_code(400);
      echo json_encode($th->getMessage());
    }
  }

  private function guidv4()
  {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = random_bytes(16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
  }

  private function validate_data(array $data)
  {
    $errors = [];
    if (!isset($data['title'])) $errors['title'] = 'no title';
    if (!isset($data['description'])) $errors['description'] = 'no description';
    if (!isset($data['category'])) $errors['category'] = 'no category';
    if (!isset($data['city'])) $errors['city'] = 'no city';
    if (!isset($data['address'])) $errors['address'] = 'no address';
    if (!isset($data['author_id'])) $errors['author_id'] = 'no author_id';
    if (count($errors)) exit(json_encode(['created' => false, 'errors' => $errors]));
  }

  private function store_single_image(array $image, bool $isCover): string|bool
  {
    $tmp_name = $image['tmp_name'];
    $uploads_dir = '/app/api/uploaded/imgs';
    try {
      $name = $this->guidv4();
      $extension = basename($image['type']);
      if (!in_array($extension, $this::ALLOWED_IMAGE_EXTENSIONS)) {
        echo 'type not allowed';
        return false;
      }
      $extension = '.' . $extension;
      $full_name = $name . $extension;
      move_uploaded_file($tmp_name, "$uploads_dir/$full_name");
      if (!$isCover) $this->model->store_item_image($this->id, $full_name);
      return $full_name;
    } catch (Throwable $e) {
      echo json_encode($e->getMessage());
      return false;
    }
  }
}
