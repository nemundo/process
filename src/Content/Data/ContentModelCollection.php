<?php
namespace Nemundo\Process\Content\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class ContentModelCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\Content\Data\Content\ContentModel());
$this->addModel(new \Nemundo\Process\Content\Data\ContentType\ContentTypeModel());
$this->addModel(new \Nemundo\Process\Content\Data\Tree\TreeModel());
}
}