<?php
namespace Nemundo\Process\App\Task\Data\TaskIndex;
class TaskIndexPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var TaskIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TaskIndexModel();
}
/**
* @return \Nemundo\Process\App\Task\Row\TaskIndexCustomRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new \Nemundo\Process\App\Task\Row\TaskIndexCustomRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}