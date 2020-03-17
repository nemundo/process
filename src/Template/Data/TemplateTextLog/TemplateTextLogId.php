<?php
namespace Nemundo\Process\Template\Data\TemplateTextLog;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateTextLogId extends AbstractModelIdValue {
/**
* @var TemplateTextLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateTextLogModel();
}
}