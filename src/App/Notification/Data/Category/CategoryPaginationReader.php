<?php
namespace Nemundo\Process\App\Notification\Data\Category;
class CategoryPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var CategoryModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CategoryModel();
}
/**
* @return CategoryRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new CategoryRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}