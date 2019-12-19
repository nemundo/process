<?php


namespace Nemundo\Process\Install;


use Nemundo\Process\App\Inbox\Install\InboxUninstall;
use Nemundo\Process\App\Wiki\Install\WikiUninstall;
use Nemundo\Process\Content\Install\ContentUninstall;
use Nemundo\Process\Workflow\Install\WorkflowUninstall;
use Nemundo\Project\Install\AbstractUninstall;
use Nemundo\ToDo\Install\ToDoUninstall;
use Schleuniger\App\ChangeRequest\Install\ChangeRequestUninstall;

class ProcessUninstall extends AbstractUninstall
{

    public function uninstall()
    {


        (new ContentUninstall())->uninstall();
        (new WorkflowUninstall())->uninstall();
        (new InboxUninstall())->uninstall();
        (new WikiUninstall())->uninstall();

        (new ChangeRequestUninstall())->uninstall();
        (new ToDoUninstall())->uninstall();

    }

}