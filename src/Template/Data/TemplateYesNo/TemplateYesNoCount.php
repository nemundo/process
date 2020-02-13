<?php
namespace Nemundo\Process\Template\Data\TemplateYesNo;
class TemplateYesNoCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateYesNoModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateYesNoModel();
}
}