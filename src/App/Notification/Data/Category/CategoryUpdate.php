<?php
namespace Nemundo\Process\App\Notification\Data\Category;
use Nemundo\Model\Data\AbstractModelUpdate;
class CategoryUpdate extends AbstractModelUpdate {
/**
* @var CategoryModel
*/
public $model;

/**
* @var string
*/
public $category;

public function __construct() {
parent::__construct();
$this->model = new CategoryModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->category, $this->category);
parent::update();
}
}