<?php


namespace Nemundo\Process\App\Notification\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\App\Notification\Content\AbstractNotificationContentType;
use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Process\App\Notification\Data\Notification\NotificationUpdate;

class NotificationUpdateScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
   $this->scriptName='notification-update';
    }


    public function run()
    {

        $reader = new NotificationReader();
        foreach ($reader->getData() as $notificationRow) {

            /** @var AbstractNotificationContentType $type */
            $type = $notificationRow->content->getContentType();

            $update = new NotificationUpdate();
            $update->message = $type->getMessage();
            $update->updateById($notificationRow->id);


        }


    }

}