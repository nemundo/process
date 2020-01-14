<?php
namespace Nemundo\Process\Template\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class TemplateCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\Template\Data\DeadlineChange\DeadlineChangeModel());
$this->addModel(new \Nemundo\Process\Template\Data\Document\DocumentModel());
$this->addModel(new \Nemundo\Process\Template\Data\Event\EventModel());
$this->addModel(new \Nemundo\Process\Template\Data\GroupAssignment\GroupAssignmentModel());
$this->addModel(new \Nemundo\Process\Template\Data\LargeText\LargeTextModel());
$this->addModel(new \Nemundo\Process\Template\Data\SourceLog\SourceLogModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateText\TemplateTextModel());
$this->addModel(new \Nemundo\Process\Template\Data\UserAssignmentLog\UserAssignmentLogModel());
$this->addModel(new \Nemundo\Process\Template\Data\Youtube\YoutubeModel());
}
}