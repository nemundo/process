<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentLog;
class AssignmentLogPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var AssignmentLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentLogModel();
}
/**
* @return AssignmentLogRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new AssignmentLogRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}