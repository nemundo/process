<?php
namespace Nemundo\Process\Template\Data\TemplateDate;
class TemplateDateDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateDateModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateModel();
}
}