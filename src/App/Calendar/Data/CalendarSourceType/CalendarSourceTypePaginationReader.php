<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarSourceType;
class CalendarSourceTypePaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var CalendarSourceTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CalendarSourceTypeModel();
}
/**
* @return CalendarSourceTypeRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new CalendarSourceTypeRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}