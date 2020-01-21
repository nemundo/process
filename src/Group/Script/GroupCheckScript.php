<?php


namespace Nemundo\Process\Group\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Group\Type\UserGroupType;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\User\Data\User\UserReader;

class GroupCheckScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'group-check';
    }


    public function run()
    {


        $reader = new UserReader();
        foreach ($reader->getData() as $userRow) {

            $type= new UserGroupType($userRow->id);
            $type->addUser($userRow->id);
            $type->saveType();
        }

    }

}