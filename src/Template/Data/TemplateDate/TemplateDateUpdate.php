<?php
namespace Nemundo\Process\Template\Data\TemplateDate;
use Nemundo\Model\Data\AbstractModelUpdate;
class TemplateDateUpdate extends AbstractModelUpdate {
/**
* @var TemplateDateModel
*/
public $model;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $date;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateModel();
$this->date = new \Nemundo\Core\Type\DateTime\Date();
}
public function update() {
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->date, $this->typeValueList);
$property->setValue($this->date);
parent::update();
}
}