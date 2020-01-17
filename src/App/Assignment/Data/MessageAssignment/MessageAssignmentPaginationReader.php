<?php
namespace Nemundo\Process\App\Assignment\Data\MessageAssignment;
class MessageAssignmentPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var MessageAssignmentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new MessageAssignmentModel();
}
/**
* @return MessageAssignmentRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new MessageAssignmentRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}