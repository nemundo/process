<?php


namespace Nemundo\Process\App\Task\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Debug\Debug;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexDelete;
use Schleuniger\App\Aufgabe\Content\Process\AufgabeProcess;
use Schleuniger\App\Aufgabe\Data\Aufgabe\AufgabeReader;

class TaskCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName='task-clean';
    }


    public function run()
    {
        (new Debug())->write('Clean Task');
        (new TaskIndexDelete())->delete();


        $reader = new AufgabeReader();
        foreach ($reader->getData() as $aufgabeRow) {

            $type=new AufgabeProcess($aufgabeRow->id);
            $type->saveIndex();
            (new Debug())->write($type->getSubject());

        }



    }

}