<?php
namespace Nemundo\Process\Template\Data\TemplateDecimalNumber;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateDecimalNumberId extends AbstractModelIdValue {
/**
* @var TemplateDecimalNumberModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDecimalNumberModel();
}
}