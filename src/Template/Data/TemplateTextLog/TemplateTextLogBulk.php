<?php
namespace Nemundo\Process\Template\Data\TemplateTextLog;
class TemplateTextLogBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var TemplateTextLogModel
*/
protected $model;

/**
* @var string
*/
public $textFrom;

/**
* @var string
*/
public $textTo;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextLogModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->textFrom, $this->textFrom);
$this->typeValueList->setModelValue($this->model->textTo, $this->textTo);
$id = parent::save();
return $id;
}
}