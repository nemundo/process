<?php


namespace Nemundo\Process\App\Notification\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Process\App\Notification\Script\NotificationCleanScript;
use Nemundo\Process\App\Notification\Script\NotificationTestScript;
use Nemundo\App\Application\Type\Install\AbstractInstall;

class NotificationTestInstall extends AbstractInstall
{

    public function install()
    {

        $setup=new ScriptSetup();
        $setup->addScript(new NotificationTestScript());
        $setup->addScript(new NotificationCleanScript());

        // TODO: Implement install() method.
    }

}