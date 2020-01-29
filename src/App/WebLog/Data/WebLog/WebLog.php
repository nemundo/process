<?php
namespace Nemundo\Process\App\WebLog\Data\WebLog;
class WebLog extends \Nemundo\Model\Data\AbstractModelData {
/**
* @var WebLogModel
*/
protected $model;

public function __construct() {
parent::__construct();
$this->model = new WebLogModel();
}
public function save() {
$id = parent::save();
return $id;
}
}