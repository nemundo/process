<?php
namespace Nemundo\Process\Group\Data;
use Nemundo\Model\Collection\AbstractModelCollection;
class GroupCollection extends AbstractModelCollection {
protected function loadCollection() {
$this->addModel(new \Nemundo\Process\Group\Data\Group\GroupModel());
$this->addModel(new \Nemundo\Process\Group\Data\GroupType\GroupTypeModel());
$this->addModel(new \Nemundo\Process\Group\Data\GroupUser\GroupUserModel());
}
}