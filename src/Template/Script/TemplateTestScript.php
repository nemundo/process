<?php


namespace Nemundo\Process\Template\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Template\Test\UserTestData;

class TemplateTestScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'template-test';
    }

    public function run()
    {

        (new UserTestData())->createTestData(20);

    }

}