<?php


namespace Nemundo\Process\Group\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Group\Data\Group\Group;
use Nemundo\Process\Group\Data\GroupType\GroupType;
use Nemundo\Process\Group\Type\AbstractGroupContentType;
use Nemundo\Process\Group\Type\AbstractGroupType;

class GroupSetup extends AbstractBase
{

    public function addGroup(AbstractGroupContentType $group, AbstractGroupType $groupType) {

        $data = new Group();
        $data->updateOnDuplicate = true;
        $data->id = $group->typeId;
        $data->group = $group->group;
        $data->groupTypeId=$groupType->id;
        $data->save();

        return $this;

    }


    public function addGroupType(AbstractGroupType $groupType) {


        $data=new GroupType();
        $data->updateOnDuplicate=true;
        $data->id=$groupType->id;
        $data->groupType=$groupType->groupType;
        $data->save();

    }

}