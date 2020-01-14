<?php
namespace Nemundo\Process\Template\Data\SourceLog;
class SourceLogValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var SourceLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SourceLogModel();
}
}