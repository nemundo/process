<?php


namespace Nemundo\Process\App\Inbox\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\App\Inbox\Install\InboxInstall;
use Nemundo\Process\App\Inbox\Install\InboxUninstall;

class InboxCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'inbox-clean';
    }


    public function run()
    {
        (new InboxUninstall())->uninstall();
        (new InboxInstall())->install();
    }

}