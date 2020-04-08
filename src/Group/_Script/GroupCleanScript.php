<?php


namespace Nemundo\Process\Group\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Group\Data\Group\GroupDelete;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Test\UserTestData;

class GroupCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName='group-clean';
    }


    public function run()
    {


        (new GroupDelete())->delete();

        $reader = new GroupReader();
        foreach ($reader->getData() as $groupRow) {

            //$groupRow->groupType->getContentType($groupRow->)

        }

    }

}