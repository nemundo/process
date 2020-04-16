<?php
namespace Nemundo\Process\Template\Data\TemplateWebFile;
class TemplateWebFileValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var TemplateWebFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateWebFileModel();
}
}