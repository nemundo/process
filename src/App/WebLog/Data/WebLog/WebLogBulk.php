<?php
namespace Nemundo\Process\App\WebLog\Data\WebLog;
class WebLogBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
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