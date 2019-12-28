<?php
namespace Nemundo\Process\Template\Data\Event;
class EventPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
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
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new EventRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}