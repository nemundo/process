<?php
namespace Nemundo\Process\Template\Data\SourceLog;
class SourceLogCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var SourceLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new SourceLogModel();
}
}