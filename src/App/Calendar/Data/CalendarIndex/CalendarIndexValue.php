<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarIndex;
class CalendarIndexValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var CalendarIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CalendarIndexModel();
}
}