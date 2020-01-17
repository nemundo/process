<?php
namespace Nemundo\Process\App\Assignment\Data\Assignment;
class AssignmentPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var AssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentModel();
}
/**
* @return AssignmentRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new AssignmentRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}