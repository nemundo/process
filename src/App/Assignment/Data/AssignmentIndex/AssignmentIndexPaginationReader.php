<?php
namespace Nemundo\Process\App\Assignment\Data\AssignmentIndex;
class AssignmentIndexPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var AssignmentIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new AssignmentIndexModel();
}
/**
* @return AssignmentIndexRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new AssignmentIndexRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}