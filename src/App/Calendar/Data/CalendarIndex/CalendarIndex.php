<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarIndex;
class CalendarIndex extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var CalendarIndexModel
*/
protected $model;

/**
* @var string
*/
public $contentId;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $date;

/**
* @var string
*/
public $title;

/**
* @var string
*/
public $place;

public function __construct() {
parent::__construct();
$this->model = new CalendarIndexModel();
$this->date = new \Nemundo\Core\Type\DateTime\Date();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->date, $this->typeValueList);
$property->setValue($this->date);
$this->typeValueList->setModelValue($this->model->title, $this->title);
$this->typeValueList->setModelValue($this->model->place, $this->place);
$id = parent::save();
return $id;
}
}