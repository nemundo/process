<?php
namespace Nemundo\Process\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class ProcessCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\Data\Process\ProcessModel());
$this->addModel(new \Nemundo\Process\Data\Status\StatusModel());
$this->addModel(new \Nemundo\Process\Data\Workflow\WorkflowModel());
$this->addModel(new \Nemundo\Process\Data\WorkflowLog\WorkflowLogModel());
}
}