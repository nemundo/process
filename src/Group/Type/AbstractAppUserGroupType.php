<?php


namespace Nemundo\Process\Group\Type;


// AppGroupType
abstract class AbstractAppUserGroupType extends AbstractGroupContentType
{

    final protected function loadContentType()
    {
        $this->typeId='363eb822-83a8-4e44-83d9-17c38fc47e82';
        $this->typeLabel='App Group';
    }



}