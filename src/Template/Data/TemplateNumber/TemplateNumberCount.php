<?php
namespace Nemundo\Process\Template\Data\TemplateNumber;
class TemplateNumberCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateNumberModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateNumberModel();
}
}