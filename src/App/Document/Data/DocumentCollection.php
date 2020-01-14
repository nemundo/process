<?php
namespace Nemundo\Process\App\Document\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class DocumentCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Document\Data\DocumentType\DocumentTypeModel());
}
}