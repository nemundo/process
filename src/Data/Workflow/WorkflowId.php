<?php
namespace Nemundo\Process\Data\Workflow;
use Nemundo\Model\Id\AbstractModelIdValue;
class WorkflowId extends AbstractModelIdValue {
/**
* @var WorkflowModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new WorkflowModel();
}
}