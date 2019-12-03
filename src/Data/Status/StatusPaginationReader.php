<?php
namespace Nemundo\Process\Data\Status;
class StatusPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var StatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new StatusModel();
}
/**
* @return StatusRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new StatusRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}