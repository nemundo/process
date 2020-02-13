<?php
namespace Nemundo\Process\Template\Data\TemplateNumber;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateNumberId extends AbstractModelIdValue {
/**
* @var TemplateNumberModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateNumberModel();
}
}