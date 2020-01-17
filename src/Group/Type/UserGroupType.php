<?php


namespace Nemundo\Process\Group\Type;


use Nemundo\User\Data\User\UserReader;

class UserGroupType extends AbstractGroupContentType
{
    protected function loadContentType()
    {

        $this->typeLabel = 'User (Content Group)';
        $this->typeId = 'd93ebc1c-5d09-49fc-be3a-68ce1469d81d';

    }


    protected function getGroupLabel()
    {

        $userRow = (new UserReader())->getRowById($this->dataId);
        return $userRow->displayName;

    }



}