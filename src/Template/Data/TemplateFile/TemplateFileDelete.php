<?php
namespace Nemundo\Process\Template\Data\TemplateFile;
class TemplateFileDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileModel();
}
}