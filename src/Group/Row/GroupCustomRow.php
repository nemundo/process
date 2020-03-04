<?php


namespace Nemundo\Process\Group\Row;


use Nemundo\Process\Group\Data\Group\GroupRow;
use Nemundo\Process\Group\Type\GroupContentType;

class GroupCustomRow extends GroupRow
{

    public function getGroup() {

        $group = (new GroupContentType())->fromGroupId($this->id);
        return $group;

    }

}