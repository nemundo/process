<?php
namespace Nemundo\Process\Template\Data\TemplateFile;
class TemplateFileCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var TemplateFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileModel();
}
}