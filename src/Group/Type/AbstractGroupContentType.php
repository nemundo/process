<?php


namespace Nemundo\Process\Group\Type;


use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Group\Data\Group\Group;
use Nemundo\Process\Group\Data\GroupUser\GroupUser;
use Nemundo\Process\Group\Data\GroupUser\GroupUserDelete;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\User\Reader\UserCustomRow;

abstract class AbstractGroupContentType extends AbstractTreeContentType  // AbstractBase
{

    public $contentId;

    public $group;

    //abstract protected function loadGroup();

    /*
    public function __construct()
    {
        $this->loadGroup();
    }*/


    public function saveType()
    {

      parent::saveType(); // TODO: Change the autogenerated stub

        $data = new Group();
        $data->updateOnDuplicate = true;
        $data->id =$this->dataId;
        $data->group = $this->group;
        $data->groupTypeId=$this->contentId;  //groupType->id;
        $data->save();


    }


    public function addUser($userId) {

        $data = new GroupUser();
        $data->ignoreIfExists=true;
        $data->groupId = $this->dataId;
        $data->userId = $userId;
        $data->save();

        return $this;

    }


    public function removeUser($userId) {


        $delete = new GroupUserDelete();
        $delete->filter->andEqual($delete->model->groupId,$this->dataId);
        $delete->filter->andEqual($delete->model->userId,$userId);
        $delete->delete();

        return $this;

    }



    public function getUserList() {

        /** @var UserCustomRow[] $list */
        $list=[];

        $reader = new GroupUserReader();
        $reader->model->loadUser();
        $reader->filter->andEqual($reader->model->groupId,$this->dataId );
        $reader->addOrder($reader->model->user->login);
        foreach ($reader->getData() as $groupUserRow) {
            $list[]=$groupUserRow->user;
            }

        return $list;

    }

}