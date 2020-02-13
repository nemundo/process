<?php
namespace Nemundo\Process\Template\Data\TemplateMultiFile;
class TemplateMultiFileDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateMultiFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateMultiFileModel();
}
}