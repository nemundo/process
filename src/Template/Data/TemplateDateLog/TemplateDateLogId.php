<?php
namespace Nemundo\Process\Template\Data\TemplateDateLog;
use Nemundo\Model\Id\AbstractModelIdValue;
class TemplateDateLogId extends AbstractModelIdValue {
/**
* @var TemplateDateLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateLogModel();
}
}