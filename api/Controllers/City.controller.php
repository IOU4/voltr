<?php

class City
{
  private CityModel $model;

  public function __construct(?int $id = null)
  {
    $this->model = new CityModel();
  }

  public static function all()
  {
    $model = new CityModel();
    try {
      $cities = $model->fetch_all();
      $cts = [];
      foreach ($cities as  $city)
        $cts[] = $city['city'];
      echo json_encode($cts);
    } catch (\Throwable $th) {
      echo json_encode($th->getMessage());
    }
  }
}
