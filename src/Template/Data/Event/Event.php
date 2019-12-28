<?php
namespace Nemundo\Process\Template\Data\Event;
class Event extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var EventModel
*/
protected $model;

/**
* @var string
*/
public $id;

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
public function save() {
$id = $this->id;
$this->typeValueList->setModelValue($this->model->id, $id);
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->date, $this->typeValueList);
$property->setValue($this->date);
$this->typeValueList->setModelValue($this->model->event, $this->event);
$id = parent::save();
return $id;
}
}