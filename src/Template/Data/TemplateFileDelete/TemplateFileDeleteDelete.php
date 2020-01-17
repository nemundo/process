<?php
namespace Nemundo\Process\Template\Data\TemplateFileDelete;
class TemplateFileDeleteDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateFileDeleteModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateFileDeleteModel();
}
}