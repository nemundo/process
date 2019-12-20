<?php
namespace Nemundo\Process\Content\Data\Tree;
class TreeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TreeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TreeModel();
}
}