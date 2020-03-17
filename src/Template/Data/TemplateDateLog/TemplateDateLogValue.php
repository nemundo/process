<?php
namespace Nemundo\Process\Template\Data\TemplateDateLog;
class TemplateDateLogValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TemplateDateLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateLogModel();
}
}