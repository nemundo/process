<?php
namespace Nemundo\Process\Template\Data\TemplateNumber;
class TemplateNumberDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateNumberModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateNumberModel();
}
}