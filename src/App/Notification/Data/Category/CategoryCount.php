<?php
namespace Nemundo\Process\App\Notification\Data\Category;
class CategoryCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var CategoryModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CategoryModel();
}
}