<?php


namespace Nemundo\Process\App\Task\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Debug\Debug;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexDelete;

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

    }

}