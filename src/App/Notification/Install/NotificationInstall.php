<?php


namespace Nemundo\Process\App\Notification\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Notification\Content\File\FileNotificationContentType;
use Nemundo\Process\App\Notification\Content\Message\MessageNotificationContentType;
use Nemundo\Process\App\Notification\Content\Reminder\ReminderNotificationStatus;
use Nemundo\Process\App\Notification\Data\NotificationCollection;
use Nemundo\Process\App\Notification\Script\NotificationUpdateScript;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class NotificationInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new NotificationCollection());

        $setup = new ContentTypeSetup();
        //$setup->addContentType(new NotificationContentType());
        $setup->addContentType(new MessageNotificationContentType());
        $setup->addContentType(new FileNotificationContentType());
        $setup->addContentType(new ReminderNotificationStatus());

        $setup = new ScriptSetup();
        $setup->addScript(new NotificationUpdateScript());

        (new NotificationTestInstall())->install();


    }

}