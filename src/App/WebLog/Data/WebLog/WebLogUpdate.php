<?php
namespace Nemundo\Process\App\WebLog\Data\WebLog;
use Nemundo\Model\Data\AbstractModelUpdate;
class WebLogUpdate extends AbstractModelUpdate {
/**
* @var WebLogModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WebLogModel();
}
public function update() {
parent::update();
}
}