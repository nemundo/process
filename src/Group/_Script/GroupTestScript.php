<?php


namespace Nemundo\Process\Group\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Group\Test\UserTestData;

class GroupTestScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName='group-test';
    }


    public function run()
    {

        (new UserTestData())->createTestData();


    }

}