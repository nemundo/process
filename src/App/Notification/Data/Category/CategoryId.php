<?php
namespace Nemundo\Process\App\Notification\Data\Category;
use Nemundo\Model\Id\AbstractModelIdValue;
class CategoryId extends AbstractModelIdValue {
/**
* @var CategoryModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CategoryModel();
}
}