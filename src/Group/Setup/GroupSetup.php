<?php


namespace Nemundo\Process\Group\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\Setup\AbstractContentTypeSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Group\Data\Group\Group;
use Nemundo\Process\Group\Data\GroupType\GroupType;
use Nemundo\Process\Group\Type\AbstractGroupContentType;


class GroupSetup extends AbstractContentTypeSetup  // ContentTypeSetup // AbstractBase
{

    /*
    public function addGroup(AbstractGroupContentType $group, AbstractGroupType $groupType) {

        $data = new Group();
        $data->updateOnDuplicate = true;
        $data->id = $group->typeId;
        $data->group = $group->group;
        $data->groupTypeId=$groupType->id;
        $data->save();

        return $this;

    }*/


    public function addGroupType(AbstractGroupContentType $groupType) {


        $this->addContentType($groupType);

        $data=new GroupType();
        $data->ignoreIfExists=true;
        $data->groupTypeId=$groupType->typeId;
        $data->save();

        return $this;

    }

}