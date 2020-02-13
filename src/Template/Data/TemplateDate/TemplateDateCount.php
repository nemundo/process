<?php
namespace Nemundo\Process\Template\Data\TemplateDate;
class TemplateDateCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateDateModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateModel();
}
}