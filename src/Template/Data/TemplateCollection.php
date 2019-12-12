<?php
namespace Nemundo\Process\Template\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class TemplateCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLogModel());
$this->addModel(new \Nemundo\Process\Template\Data\DeadlineChange\DeadlineChangeModel());
$this->addModel(new \Nemundo\Process\Template\Data\Document\DocumentModel());
$this->addModel(new \Nemundo\Process\Template\Data\LargeText\LargeTextModel());
}
}