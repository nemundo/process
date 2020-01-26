<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentSource;
class AssignmentSourcePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var AssignmentSourceModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentSourceModel();
}
/**
* @return AssignmentSourceRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new AssignmentSourceRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}