<?php
namespace Nemundo\Process\App\Assignment\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class AssignmentCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Assignment\Data\Assignment\AssignmentModel());
$this->addModel(new \Nemundo\Process\App\Assignment\Data\AssignmentIndex\AssignmentIndexModel());
$this->addModel(new \Nemundo\Process\App\Assignment\Data\AssignmentLog\AssignmentLogModel());
$this->addModel(new \Nemundo\Process\App\Assignment\Data\AssignmentSource\AssignmentSourceModel());
$this->addModel(new \Nemundo\Process\App\Assignment\Data\AssignmentStatus\AssignmentStatusModel());
$this->addModel(new \Nemundo\Process\App\Assignment\Data\MessageAssignment\MessageAssignmentModel());
}
}