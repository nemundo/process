<?php


namespace Nemundo\Process\Group\Type;


use Nemundo\Process\Group\Data\Group\Group;

trait GroupContentTrait
{

    protected function saveGroupIndex()
    {

        $data = new Group();
        $data->updateOnDuplicate = true;
        $data->id = $this->getGroupId();
        $data->active = true;
        $data->group = $this->getGroupLabel();
        $data->groupTypeId = $this->typeId;
        $data->save();

    }


}