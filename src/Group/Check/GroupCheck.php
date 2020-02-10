<?php


namespace Nemundo\Process\Group\Check;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Group\Data\GroupUser\GroupUserCount;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\Process\Group\Type\AbstractGroupContentType;
use Nemundo\User\Type\UserSessionType;


// GroupUser
class GroupCheck extends AbstractBase
{


   /* public function checkVisiblity() {

       // $userId = (new UserSessionType())->

    }*/


    public function isMemberOfGroup(AbstractGroupContentType $groupContentType) {

        $value=false;

        $count=new GroupUserCount();
        $count->filter->andEqual($count->model->userId, (new UserSessionType())->userId);
        $count->filter->andEqual($count->model->groupId,$groupContentType->getGroupId());
        if ($count->getCount()>0) {
            $value=true;
        }

        return $value;


        /*
                $reader = new GroupUserReader();
                $reader->model->loadGroup();
                $reader->model->group->loadGroupType();
                $reader->filter->andEqual($reader->model->userId, $this->dataId);
                $reader->addOrder($reader->model->group->group);
                foreach ($reader->getData() as $groupUserRow) {
                    $list[] = $groupUserRow->group;
                }*/


    }

}