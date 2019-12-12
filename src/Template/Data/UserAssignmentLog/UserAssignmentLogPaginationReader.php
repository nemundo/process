<?php
namespace Nemundo\Process\Template\Data\UserAssignmentLog;
class UserAssignmentLogPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var UserAssignmentLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new UserAssignmentLogModel();
}
/**
* @return UserAssignmentLogRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new UserAssignmentLogRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}