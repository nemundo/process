<?php
namespace Nemundo\Process\App\Wiki\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class WikiCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Wiki\Data\Wiki\WikiModel());
$this->addModel(new \Nemundo\Process\App\Wiki\Data\WikiType\WikiTypeModel());
}
}