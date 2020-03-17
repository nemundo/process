<?php
namespace Nemundo\Process\Template\Data\TemplateTextLog;
class TemplateTextLogCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateTextLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextLogModel();
}
}