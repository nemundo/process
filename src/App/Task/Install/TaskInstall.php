<?php


namespace Nemundo\Process\App\Task\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Task\Data\TaskCollection;
use Nemundo\Process\App\Task\Script\TaskCleanScript;
use Nemundo\Project\Install\AbstractInstall;

class TaskInstall extends AbstractInstall
{

    public function install()
    {

        (new ModelCollectionSetup())
            ->addCollection(new TaskCollection());


        (new ScriptSetup())
            ->addScript(new TaskCleanScript());

        // TODO: Implement install() method.
    }

}