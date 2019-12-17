<?php
namespace Nemundo\Process\Workflow\Data\Status;
class StatusDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var StatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new StatusModel();
}
}