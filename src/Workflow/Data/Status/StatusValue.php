<?php
namespace Nemundo\Process\Workflow\Data\Status;
class StatusValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var StatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new StatusModel();
}
}