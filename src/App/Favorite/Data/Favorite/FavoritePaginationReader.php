<?php
namespace Nemundo\Process\App\Favorite\Data\Favorite;
class FavoritePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var FavoriteModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FavoriteModel();
}
/**
* @return FavoriteRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new FavoriteRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}