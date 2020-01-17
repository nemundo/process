<?php
namespace Nemundo\Process\Template\Data\TemplateFileDelete;
class TemplateFileDeleteCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateFileDeleteModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileDeleteModel();
}
}