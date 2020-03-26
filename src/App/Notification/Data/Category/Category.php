<?php
namespace Nemundo\Process\App\Notification\Data\Category;
class Category extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var CategoryModel
*/
protected $model;

/**
* @var int
*/
public $id;

/**
* @var string
*/
public $category;

public function __construct() {
parent::__construct();
$this->model = new CategoryModel();
}
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$this->typeValueList->setModelValue($this->model->category, $this->category);
$id = parent::save();
return $id;
}
}