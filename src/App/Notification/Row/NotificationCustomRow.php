<?php


namespace Nemundo\Process\App\Notification\Row;


use Nemundo\Process\App\Notification\Content\AbstractNotificationContentType;
use Nemundo\Process\App\Notification\Data\Notification\NotificationRow;

class NotificationCustomRow extends NotificationRow
{

    public function getNotificationContentType() {

        /** @var AbstractNotificationContentType $notificationContentType */
        $notificationContentType = $this->content->getContentType();

        return $notificationContentType;

    }


    public function getSubjectContentType() {

    }


}