<?php


namespace Nemundo\Process\App\Task\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Dashboard\Setup\DashboardSetup;
use Nemundo\Process\App\Task\Content\TaskWidgetContentType;
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

        (new TaskWidgetContentType())
            ->saveType();

        (new DashboardSetup())
            ->addDashboard(new TaskWidgetContentType());


        // TODO: Implement install() method.
    }

}