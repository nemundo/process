<?php
namespace Nemundo\Process\Cms\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class CmsCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\Cms\Data\Cms\CmsModel());
$this->addModel(new \Nemundo\Process\Cms\Data\CmsType\CmsTypeModel());
}
}