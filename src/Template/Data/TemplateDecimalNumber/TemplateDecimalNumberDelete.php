<?php
namespace Nemundo\Process\Template\Data\TemplateDecimalNumber;
class TemplateDecimalNumberDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateDecimalNumberModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDecimalNumberModel();
}
}