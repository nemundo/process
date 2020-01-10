<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarIndex;
class CalendarIndexCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var CalendarIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CalendarIndexModel();
}
}