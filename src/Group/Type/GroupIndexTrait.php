<?php


namespace Nemundo\Process\Group\Type;


use Nemundo\Process\Group\Data\Group\Group;
use Nemundo\Process\Group\Data\Group\GroupDelete;
use Nemundo\Process\Group\Data\Group\GroupId;
use Nemundo\Process\Group\Data\GroupUser\GroupUser;
use Nemundo\Process\Group\Data\GroupUser\GroupUserDelete;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\User\Reader\UserCustomRow;

trait GroupIndexTrait
{


    protected $groupIdTmp;

    abstract protected function getGroupLabel();


    protected function saveGroupIndex()
    {

        $data = new Group();
        $data->updateOnDuplicate = true;
        $data->active = $this->isActive();
        $data->group = $this->getGroupLabel();
        $data->groupTypeId = $this->typeId;
        $data->contentId = $this->getContentId();
        $data->save();

    }


    protected function deleteGroupIndex()
    {

        (new GroupDelete())->deleteById($this->getGroupId());

        $delete = new GroupUserDelete();
        $delete->filter->andEqual($delete->model->groupId, $this->dataId);
        $delete->delete();

    }


    public function addUser($userId)
    {

        $data = new GroupUser();
        $data->ignoreIfExists = true;
        $data->groupId = $this->getGroupId();
        $data->userId = $userId;
        $data->save();

        return $this;

    }


    public function getGroupId()
    {

        if ($this->groupIdTmp == null) {

            $id = new GroupId();
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