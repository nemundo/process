<?php


namespace Nemundo\Process\Script;


use App\App\IssueTracker\Test\IssueTestData;
use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Structure\ForLoop;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\Process\Template\Test\TextTestData;

class ProcessTestScript extends AbstractConsoleScript
{
    protected function loadScript()
    {
        $this->scriptName = 'process-test';
    }

    public function run()
    {


        $loop = new ForLoop();
        $loop->minNumber = 1;
        $loop->maxNumber = 10000;
        foreach ($loop->getData() as $number) {
            (new TextTestData())->createTestData(10000);
        }




    }

}