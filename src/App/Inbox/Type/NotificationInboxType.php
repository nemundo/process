<?php


namespace Nemundo\Process\App\Inbox\Type;


use Nemundo\Process\App\Notification\Com\Container\UserNotificationContainer;

class NotificationInboxType extends AbstractInboxType
{

    protected function loadType()
    {

        $this->id = 'notification';
        $this->title = 'Notification';
        $this->containerClass = UserNotificationContainer::class;

    }

}