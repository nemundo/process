<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarIndex;
class CalendarIndexPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
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
$row = new CalendarIndexRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}