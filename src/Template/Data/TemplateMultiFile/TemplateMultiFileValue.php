<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile;
class TemplateMultiFileValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TemplateMultiFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiFileModel();
}
}