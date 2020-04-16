<?php
namespace Nemundo\Process\Template\Data\TemplateWebFile;
class TemplateWebFileDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateWebFileModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateWebFileModel();
}
}