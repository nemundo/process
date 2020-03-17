<?php
namespace Nemundo\Process\Template\Data\TemplateTextLog;
class TemplateTextLogDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateTextLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextLogModel();
}
}