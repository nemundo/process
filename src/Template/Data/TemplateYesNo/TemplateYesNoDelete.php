<?php
namespace Nemundo\Process\Template\Data\TemplateYesNo;
class TemplateYesNoDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateYesNoModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateYesNoModel();
}
}