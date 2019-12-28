<?php
namespace Nemundo\Process\Template\Data\Event;
use Nemundo\Model\Data\AbstractModelUpdate;
class EventUpdate extends AbstractModelUpdate {
/**
* @var EventModel
*/
public $model;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $date;

/**
* @var string
*/
public $event;

public function __construct() {
parent::__construct();
$this->model = new EventModel();
$this->date = new \Nemundo\Core\Type\DateTime\Date();
}
public function update() {
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->date, $this->typeValueList);
$property->setValue($this->date);
$this->typeValueList->setModelValue($this->model->event, $this->event);
parent::update();
}
}