<?php


namespace Nemundo\Process\App\Notification\Content\Reminder;

use Nemundo\Process\App\Notification\Content\AbstractNotificationContentType;
use Nemundo\Process\Workflow\Content\Status\ProcessStatusTrait;
use Nemundo\User\Data\User\UserReader;

class ReminderNotificationStatus extends AbstractNotificationContentType
{

    use ProcessStatusTrait;

    protected function loadContentType()
    {
        // TODO: Implement loadContentType() method.

        $this->typeLabel='Reminder';
        $this->typeId='5aeea740-3bda-4b54-bf8f-6e50f9c16f45';


    }


    protected function onCreate()
    {



        $userRow = (new UserReader())->getRow();
        $this->toUserId=$userRow->id;

        //$this->message = 'blieb da was liegen???';

        parent::onCreate();

        // an responsible

    }


    public function getMessage()
    {
        $message = 'REMINDER!!!';
        return $message;

        }


}