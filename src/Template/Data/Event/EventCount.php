<?php
namespace Nemundo\Process\Template\Data\Event;
class EventCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var EventModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new EventModel();
}
}