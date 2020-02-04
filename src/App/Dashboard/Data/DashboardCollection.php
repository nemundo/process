<?php
namespace Nemundo\Process\App\Dashboard\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class DashboardCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\App\Dashboard\Data\Dashboard\DashboardModel());
}
}