<?php
namespace Nemundo\Process\Workflow\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class WorkflowCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\Workflow\Data\Process\ProcessModel());
$this->addModel(new \Nemundo\Process\Workflow\Data\Status\StatusModel());
$this->addModel(new \Nemundo\Process\Workflow\Data\Workflow\WorkflowModel());
}
}