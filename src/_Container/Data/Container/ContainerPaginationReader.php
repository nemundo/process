<?php
namespace Nemundo\Process\Container\Data\Container;
class ContainerPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var ContainerModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContainerModel();
}
/**
* @return ContainerRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new ContainerRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}