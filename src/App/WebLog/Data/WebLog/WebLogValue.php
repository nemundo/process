<?php
namespace Nemundo\Process\App\WebLog\Data\WebLog;
class WebLogValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var WebLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WebLogModel();
}
}