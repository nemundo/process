<?php
namespace Nemundo\Process\Template\Data\TemplateDecimalNumber;
class TemplateDecimalNumberCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateDecimalNumberModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDecimalNumberModel();
}
}