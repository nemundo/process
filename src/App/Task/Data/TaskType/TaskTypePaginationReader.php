<?php
namespace Nemundo\Process\App\Task\Data\TaskType;
class TaskTypePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TaskTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskTypeModel();
}
/**
* @return TaskTypeRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new TaskTypeRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}