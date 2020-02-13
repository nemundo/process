<?php
namespace Nemundo\Process\Template\Data\TemplateYesNo;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateYesNoId extends AbstractModelIdValue {
/**
* @var TemplateYesNoModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateYesNoModel();
}
}