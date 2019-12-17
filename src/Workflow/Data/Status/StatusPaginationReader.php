<?php
namespace Nemundo\Process\Workflow\Data\Status;
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
* @return \Nemundo\Process\Workflow\Row\StatusCustomRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new \Nemundo\Process\Workflow\Row\StatusCustomRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}