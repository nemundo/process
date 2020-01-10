<?php
namespace Nemundo\Process\App\Calendar\Data\CalendarSourceType;
use Nemundo\Model\Data\AbstractModelUpdate;
class CalendarSourceTypeUpdate extends AbstractModelUpdate {
/**
* @var CalendarSourceTypeModel
*/
public $model;

/**
* @var string
*/
public $contentTypeId;

public function __construct() {
parent::__construct();
$this->model = new CalendarSourceTypeModel();
}
public function update() {
$this->typeValueList->setModelValue($this->model->contentTypeId, $this->contentTypeId);
parent::update();
}
}