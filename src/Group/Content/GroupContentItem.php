<?php


namespace Nemundo\Process\Group\Content;


use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Group\Data\Group\Group;
use Nemundo\Process\Group\Data\GroupUser\GroupUser;

class GroupContentItem extends AbstractContentItem
{

    //public $id;

    public $group;


    /*
    public function __construct()
    {

        $this->loadGroup();
    }*/


    public function saveItem()
    {
        // TODO: Implement saveItem() method.

        $data = new Group();
        $data->updateOnDuplicate = true;
        $data->id = $this->dataId;
        $data->group = $this->group;
        $data->save();


    }


    public function addUser($userId)
    {
        $data = new GroupUser();
        $data->groupId = $this->dataId;
        $data->userId = $userId;
        $data->save();

        //exit;

        return $this;
    }

}