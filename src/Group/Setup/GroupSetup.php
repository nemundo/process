<?php


namespace Nemundo\Process\Group\Setup;


use Nemundo\Process\Content\Setup\AbstractContentTypeSetup;
use Nemundo\Process\Group\Data\Group\GroupDelete;
use Nemundo\Process\Group\Data\GroupType\GroupType;
use Nemundo\Process\Group\Type\AbstractGroupContentType;


class GroupSetup extends AbstractContentTypeSetup
{

    public function addGroupType(AbstractGroupContentType $groupType)
    {

        $this->addContentType($groupType);

        $data = new GroupType();
        $data->updateOnDuplicate = true;
        $data->groupTypeId = $groupType->typeId;
       $data->setupStatus=true;
        $data->save();

        return $this;

    }


    public function removeGroupContent(AbstractGroupContentType $groupType) {


        $delete = new GroupDelete();
        $delete->filter->andEqual($delete->model->groupTypeId,$groupType->typeId);
        $delete->delete();


    }


}