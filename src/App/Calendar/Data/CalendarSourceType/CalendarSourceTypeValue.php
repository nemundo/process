<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarSourceType;
class CalendarSourceTypeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var CalendarSourceTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CalendarSourceTypeModel();
}
}