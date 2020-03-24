<?php


namespace Nemundo\Process\App\Notification\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\App\Notification\Content\Message\MessageNotificationContentType;
use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Process\Template\Content\Text\TextContentType;
use Nemundo\User\Data\User\UserReader;

class NotificationIndexScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'notification-index';
    }

    public function run()
    {

        $reader = new NotificationReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();
        foreach ($reader->getData() as $notificationRow) {

           $contentType= $notificationRow->getContentType();
           $contentType->saveIndex();

        }

    }

}