<?php


namespace Nemundo\Process\Group\Setup;


use Nemundo\Process\Content\Setup\AbstractContentTypeSetup;
use Nemundo\Process\Group\Data\GroupType\GroupType;
use Nemundo\Process\Group\Type\AbstractGroupContentType;


class GroupSetup extends AbstractContentTypeSetup
{

    public function addGroupType(AbstractGroupContentType $groupType)
    {

        $this->addContentType($groupType);

        $data = new GroupType();
        $data->ignoreIfExists = true;
        $data->groupTypeId = $groupType->typeId;
        $data->save();

        return $this;

    }

}