<?php
namespace Nemundo\Process\App\WebLog\Data\WebLog;
class WebLogCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var WebLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WebLogModel();
}
}