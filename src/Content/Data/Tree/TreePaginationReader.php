<?php
namespace Nemundo\Process\Content\Data\Tree;
class TreePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TreeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TreeModel();
}
/**
* @return TreeRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TreeRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}