<?php


namespace Nemundo\Process\App\Wiki\Group;


class WikiEditorGroup extends WikiGroupType // AbstractAppUserGroupType
{

    protected function loadGroup()
    {

        $this->group = 'Wiki Editor';
        $this->groupId = '1417e187-77be-40a2-b34f-a33257dec6d7';

    }

}