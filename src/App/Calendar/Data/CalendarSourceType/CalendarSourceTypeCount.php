<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarSourceType;
class CalendarSourceTypeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var CalendarSourceTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CalendarSourceTypeModel();
}
}