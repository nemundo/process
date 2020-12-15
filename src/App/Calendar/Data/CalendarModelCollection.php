<?php
namespace Nemundo\Process\App\Calendar\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class CalendarModelCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Calendar\Data\CalendarIndex\CalendarIndexModel());
$this->addModel(new \Nemundo\Process\App\Calendar\Data\CalendarSourceType\CalendarSourceTypeModel());
}
}