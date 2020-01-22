<?php


namespace Nemundo\Process\App\Notification\Content;


use Nemundo\Process\App\Notification\Data\Notification\Notification;
use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Text\BoldText;

abstract class AbstractNotificationContentType extends AbstractTreeContentType
{

    public $subjectContentId;

    public $userToId;

    public $message;


    protected function onCreate()
    {

        if ($this->subjectContentId == null) {
            $this->subjectContentId = $this->parentId;
        }

        $this->saveNotification();

    }


    protected function saveNotification()
    {


        $data = new Notification();
        $data->toId = $this->userToId;
        $data->subjectContentId = $this->subjectContentId;
        $data->contentId = $this->getContentId();
        $data->message = $this->getMessage();  // $this->message;
        $this->dataId = $data->save();

    }


    public function getDataRow()
    {
        $reader = new NotificationReader();
        $reader->model->loadContent();
        $reader->model->content->loadUser();
        $notificationRow = $reader->getRowById($this->dataId);
        return $notificationRow;
    }

    public function getSubject()
    {
        $subject = 'Notification to ' . (new BoldText())->getBold($this->getDataRow()->content->user->displayName);
        return $subject;
    }


    public function getMessage()
    {
        return $this->message;
    }

}