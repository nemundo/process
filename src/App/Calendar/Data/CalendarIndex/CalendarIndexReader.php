<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarIndex;
class CalendarIndexReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var CalendarIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CalendarIndexModel();
}
/**
* @return CalendarIndexRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return CalendarIndexRow
*/
public function getRow() {
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return CalendarIndexRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new CalendarIndexRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}