<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarIndex;
use Nemundo\Model\Id\AbstractModelIdValue;
class CalendarIndexId extends AbstractModelIdValue {
/**
* @var CalendarIndexModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CalendarIndexModel();
}
}