<?php
namespace Nemundo\Process\Template\Data\TemplateFile;
class TemplateFileValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TemplateFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileModel();
}
}