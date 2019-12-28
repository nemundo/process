<?php
namespace Nemundo\Process\Template\Data\Event;
class EventReader extends \Nemundo\Model\Reader\ModelDataReader {
/**
* @var EventModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new EventModel();
}
/**
* @return EventRow[]
*/
public function getData() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$list = [];
foreach (parent::getData() as $dataRow) {
$row = $this->getModelRow($dataRow);
$list[] = $row;
}
return $list;
}
/**
* @return EventRow
*/
public function getRow() {
$this->addFieldByModel($this->model);
$this->checkExternal($this->model);
$dataRow = parent::getRow();
$row = $this->getModelRow($dataRow);
return $row;
}
/**
* @return EventRow
*/
public function getRowById($id) {
return parent::getRowById($id);
}
private function getModelRow($dataRow) {
$row = new EventRow($dataRow, $this->model);
$row->model = $this->model;
return $row;
}
}