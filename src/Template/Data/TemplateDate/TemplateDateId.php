<?php
namespace Nemundo\Process\Template\Data\TemplateDate;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateDateId extends AbstractModelIdValue {
/**
* @var TemplateDateModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateModel();
}
}