<?php
namespace Nemundo\Process\App\Share\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class ShareModelCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Share\Data\Share\ShareModel());
}
}