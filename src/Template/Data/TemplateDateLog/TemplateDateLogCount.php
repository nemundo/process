<?php
namespace Nemundo\Process\Template\Data\TemplateDateLog;
class TemplateDateLogCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateDateLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateLogModel();
}
}