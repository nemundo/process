<?php
namespace Nemundo\Process\App\Contact\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class ContactModelCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Contact\Data\Contact\ContactModel());
}
}