<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarIndex;
class CalendarIndexDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var CalendarIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CalendarIndexModel();
}
}