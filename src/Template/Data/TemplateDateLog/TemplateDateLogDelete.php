<?php
namespace Nemundo\Process\Template\Data\TemplateDateLog;
class TemplateDateLogDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var TemplateDateLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new TemplateDateLogModel();
}
}