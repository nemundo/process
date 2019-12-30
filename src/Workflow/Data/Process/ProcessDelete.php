<?php
namespace Nemundo\Process\Workflow\Data\Process;
class ProcessDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var ProcessModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ProcessModel();
}
}