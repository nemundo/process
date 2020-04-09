<?php
namespace Nemundo\Process\App\Assignment\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class AssignmentCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Assignment\Data\AssignmentLog\AssignmentLogModel());
}
}