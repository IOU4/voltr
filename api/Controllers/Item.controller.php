<?php

class Item
{
  private int $id;
  private string $title;
  private string $description;
  private int $author_id;
  private string $author_name;
  private string $cover;
  private string $category;
  private ItemModel $model;

  public function __construct(?int $id = null)
  {
    $this->model = new ItemModel();
    if (!$id) return;
    $db_data = $this->get_item_by_id($id);
    if (!$db_data) return;
    $this->id = $id;
    $this->title = $db_data['title'];
    $this->description = $db_data['description'];
    $this->author_id = $db_data['author_id'];
    $this->author_name = $db_data['author_name'];
    $this->cover = $db_data['cover'];
    $this->category = $db_data['category'];
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

  public static function all()
  {
    $model = new ItemModel();
    echo json_encode($model->fetch_all());
  }
}
