<?php


namespace Nemundo\Process\App\Notification\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Notification\Content\Message\MessageNotificationContentType;
use Nemundo\Process\App\Notification\Content\NotificationContentType;
use Nemundo\Process\App\Notification\Data\NotificationCollection;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractUninstall;

class NotificationUninstall extends AbstractUninstall
{

    public function uninstall()
    {

        $setup=new ModelCollectionSetup();
        $setup->removeCollection(new NotificationCollection());

        $setup=new ContentTypeSetup();
        //$setup->addContentType(new NotificationContentType());
        $setup->removeContentType(new MessageNotificationContentType());


    }

}