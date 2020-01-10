<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarSourceType;
use Nemundo\Model\Id\AbstractModelIdValue;
class CalendarSourceTypeId extends AbstractModelIdValue {
/**
* @var CalendarSourceTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CalendarSourceTypeModel();
}
}