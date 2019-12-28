<?php


namespace Nemundo\Process\Group\Content;


use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Group\Content\Group\GroupContentType;
use Nemundo\Process\Group\Data\Group\Group;
use Nemundo\Process\Group\Data\GroupUser\GroupUser;

class GroupContentItem extends AbstractContentItem
{

    public $group;


    protected function saveData()
    {


        $this->contentType=new GroupContentType();

        $data = new Group();
        $data->updateOnDuplicate = true;
        $data->id = $this->dataId;
        $data->group = $this->group;
        $data->save();


    }


    public function addUser($userId)
    {
        $data = new GroupUser();
        $data->ignoreIfExists=true;
        $data->groupId = $this->dataId;
        $data->userId = $userId;
        $data->save();

        return $this;
    }

}