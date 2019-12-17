<?php
namespace Nemundo\Process\Data\Status;
class StatusCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var StatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new StatusModel();
}
}