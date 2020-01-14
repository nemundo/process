<?php
namespace Nemundo\Process\Template\Data\TemplateText;
class TemplateTextCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateTextModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextModel();
}
}