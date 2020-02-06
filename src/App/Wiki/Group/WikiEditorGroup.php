<?php


namespace Nemundo\Process\App\Wiki\Group;


use Nemundo\Process\Group\Type\AbstractAppUserGroupType;

class WikiEditorGroup extends AbstractAppUserGroupType
{

    protected function loadGroup()
    {

        $this->group = 'Wiki Editor';
        $this->dataId = '1417e187-77be-40a2-b34f-a33257dec6d7';

    }

}