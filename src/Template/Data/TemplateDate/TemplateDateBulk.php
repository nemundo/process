<?php
namespace Nemundo\Process\Template\Data\TemplateDate;
class TemplateDateBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var TemplateDateModel
*/
protected $model;

/**
* @var \Nemundo\Core\Type\DateTime\Date
*/
public $date;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateModel();
$this->date = new \Nemundo\Core\Type\DateTime\Date();
}
public function save() {
$property = new \Nemundo\Model\Data\Property\DateTime\DateDataProperty($this->model->date, $this->typeValueList);
$property->setValue($this->date);
$id = parent::save();
return $id;
}
}