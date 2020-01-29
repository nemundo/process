<?php
namespace Nemundo\Process\App\WebLog\Data\WebLog;
class WebLogDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var WebLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WebLogModel();
}
}