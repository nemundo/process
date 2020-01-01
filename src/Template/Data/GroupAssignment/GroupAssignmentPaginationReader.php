<?php
namespace Nemundo\Process\Template\Data\GroupAssignment;
class GroupAssignmentPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var GroupAssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GroupAssignmentModel();
}
/**
* @return GroupAssignmentRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new GroupAssignmentRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}