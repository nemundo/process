<?php


namespace Nemundo\Process\Group\Type;


use Nemundo\Process\Group\Data\Group\Group;
use Nemundo\Process\Group\Data\Group\GroupDelete;
use Nemundo\Process\Group\Data\Group\GroupId;
use Nemundo\Process\Group\Data\GroupUser\GroupUser;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\User\Reader\UserCustomRow;

trait GroupIndexTrait
{


    protected $groupIdTmp;

    abstract protected function getGroupLabel();


    protected function saveGroupIndex()
    {


        //if ($this->isActive()) {

            $data = new Group();
            $data->updateOnDuplicate = true;
            //$data->id = $this->getGroupId();
            $data->active = $this->isActive();
            $data->group = $this->getGroupLabel();
            $data->groupTypeId = $this->typeId;
            $data->contentId = $this->getContentId();
            $data->save();

            /*
        } else {


            $data = new Group();
            $data->updateOnDuplicate = true;
            //$data->id = $this->getGroupId();
            $data->active = false;
            $data->group = $this->getGroupLabel();
            $data->groupTypeId = $this->typeId;
            $data->contentId = $this->getContentId();
            $data->save();

            /*
            $delete = new GroupDelete();
            $delete->filter->andEqual($delete->model->contentId, $this->getContentId());
            $delete->delete();
*/

        //}

    }


    public function addUser($userId)
    {

        $data = new GroupUser();
        $data->ignoreIfExists = true;
        $data->groupId = $this->getGroupId();  // $this->groupId;
        $data->userId = $userId;
        $data->save();

        return $this;


    }


    public function getGroupId()
    {

        if ($this->groupIdTmp == null) {
            //$this->groupId = (new UniqueId())->getUniqueId();

            $id = new GroupId();
            //$id->filter->andEqual($id->model->groupTypeId, $this->typeId);
            $id->filter->andEqual($id->model->contentId, $this->getContentId());
            $this->groupIdTmp = $id->getId();

        }

        return $this->groupIdTmp;

    }



    public function getUserList()
    {


         /** @var UserCustomRow[] $list */
         $list = [];

         $reader = new GroupUserReader();
         $reader->model->loadUser();
         $reader->filter->andEqual($reader->model->groupId, $this->getGroupId());
         $reader->addOrder($reader->model->user->login);
         foreach ($reader->getData() as $groupUserRow) {
             $list[] = $groupUserRow->user;
         }

         return $list;

     }



}