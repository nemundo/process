<?php
namespace Nemundo\Process\Template\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class TemplateCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\Template\Data\DeadlineChange\DeadlineChangeModel());
$this->addModel(new \Nemundo\Process\Template\Data\Event\EventModel());
$this->addModel(new \Nemundo\Process\Template\Data\LargeText\LargeTextModel());
$this->addModel(new \Nemundo\Process\Template\Data\SourceLog\SourceLogModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateDate\TemplateDateModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateDateLog\TemplateDateLogModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateDecimalNumber\TemplateDecimalNumberModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateFile\TemplateFileModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateFileDelete\TemplateFileDeleteModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateImage\TemplateImageModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateImageIndex\TemplateImageIndexModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFileModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateMultiImage\TemplateMultiImageModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateNumber\TemplateNumberModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateText\TemplateTextModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateTextLog\TemplateTextLogModel());
$this->addModel(new \Nemundo\Process\Template\Data\TemplateYesNo\TemplateYesNoModel());
$this->addModel(new \Nemundo\Process\Template\Data\Youtube\YoutubeModel());
}
}