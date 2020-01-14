<?php
namespace Nemundo\Process\Template\Data\SourceLog;
class SourceLogDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var SourceLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SourceLogModel();
}
}