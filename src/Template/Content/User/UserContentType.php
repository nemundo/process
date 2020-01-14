<?php


namespace Nemundo\Process\Template\Content\User;


use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Group\Data\Group\GroupRow;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\User\Data\User\UserReader;
use Nemundo\User\Reader\UserCustomRow;

class UserContentType extends AbstractContentType
{

    protected function loadContentType()
    {
        $this->typeLabel='User';
        $this->typeId='8ef8e1d2-0c15-45b0-ba10-7c306d617406';
$this->viewClass=UserContentView::class;

    }


    public function getSubject()
    {

        $userRow = (new UserReader())->getRowById($this->dataId);
        return $userRow->login;

    }


    public function getGroupList() {

            /** @var GroupRow[] $list */
            $list=[];

            $reader = new GroupUserReader();
            $reader->model->loadGroup();
            $reader->model->group->loadGroupType();
            $reader->filter->andEqual($reader->model->userId,$this->dataId );
            $reader->addOrder($reader->model->group->group);
            foreach ($reader->getData() as $groupUserRow) {
                $list[]=$groupUserRow->group;
            }

            return $list;

    }

    public function getGroupIdList() {

        (new Debug())->write('no function');

    }

}