<?php


namespace Nemundo\Process\Group\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Group\Data\Group\Group;
use Nemundo\Process\Group\Type\AbstractGroup;

class GroupSetup extends AbstractBase
{

    public function addGroup(AbstractGroup $group) {

        $data = new Group();
        $data->updateOnDuplicate = true;
        $data->id = $group->id;
        $data->group = $group->group;
        $data->save();

        return $this;

    }

}