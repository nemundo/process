<?php
namespace Nemundo\Process\Content\Data\Tree;
class TreeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TreeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TreeModel();
}
}