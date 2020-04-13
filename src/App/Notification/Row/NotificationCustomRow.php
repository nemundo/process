<?php


namespace Nemundo\Process\App\Notification\Row;


use Nemundo\Process\App\Notification\Content\AbstractNotificationContentType;
use Nemundo\Process\App\Notification\Data\Notification\NotificationRow;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class NotificationCustomRow extends NotificationRow
{



    // getNotificationContentType
    public function getContentType() {

        /** @var AbstractTreeContentType $notificationContentType */
        $notificationContentType = $this->content->getContentType();

        return $notificationContentType;

    }


    /*
    public function getNotificationContentType() {

        /** @var AbstractNotificationContentType $notificationContentType */
    /*    $notificationContentType = $this->content->getContentType();

        return $notificationContentType;

    }


    public function getSubjectContentType() {

    }*/


}