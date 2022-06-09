<?php

class Category
{
  private CategoryModel $model;

  public function __construct(?int $id = null)
  {
    $this->model = new CategoryModel();
  }

  public static function all()
  {
    $model = new CategoryModel();
    try {
      $catgories = $model->fetch_all();
      $cats = [];
      foreach ($catgories as  $category)
        $cats[] = $category['category'];
      echo json_encode($cats);
    } catch (\Throwable $th) {
      echo json_encode($th->getMessage());
    }
  }
}
