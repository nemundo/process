<?php


namespace Nemundo\Process\Template\Content\User;


use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Group\Data\Group\GroupRow;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\Process\Group\Type\UserGroupType;
use Nemundo\User\Data\User\UserReader;
use Schleuniger\App\Org\Group\MitarbeiterGroupContentType;

class UserContentType extends AbstractContentType
{

    protected function loadContentType()
    {
        $this->typeLabel = 'User';
        $this->typeId = '8ef8e1d2-0c15-45b0-ba10-7c306d617406';
        $this->viewClass = UserContentView::class;

    }


    public function getSubject()
    {

        $userRow = (new UserReader())->getRowById($this->dataId);
        return $userRow->login;

    }


    // getUserGroupId
    public function getGroupId() {

        $groupId = null;

        $reader = new GroupUserReader();
        $reader->model->loadGroup();
        $reader->filter->andEqual($reader->model->group->groupTypeId, (new UserGroupType())->typeId);
        $reader->filter->andEqual($reader->model->userId,$this->dataId);
        foreach ($reader->getData() as $groupUserRow) {
            $groupId = $groupUserRow->groupId;
        }

        if ($groupId == null) {
            (new LogMessage())->writeError('No User Group Id');
        }


        return $groupId;

    }



    // getGroupList
    public function getGroupMembershipList()
    {

        /** @var GroupRow[] $list */
        $list = [];

        $reader = new GroupUserReader();
        $reader->model->loadGroup();
        $reader->model->group->loadGroupType();
        $reader->filter->andEqual($reader->model->userId, $this->dataId);
        $reader->addOrder($reader->model->group->group);
        foreach ($reader->getData() as $groupUserRow) {
            $list[] = $groupUserRow->group;
        }

        return $list;

    }

    public function getGroupIdList()
    {

        $list = [];

        $reader = new GroupUserReader();
         $reader->filter->andEqual($reader->model->userId, $this->dataId);
        foreach ($reader->getData() as $groupUserRow) {
            $list[] = $groupUserRow->groupId;
        }

        return $list;
    }

}