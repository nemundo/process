<?php


namespace Nemundo\Process\App\Notification\Type;


use Nemundo\Process\App\Notification\Data\Notification\Notification;
use Nemundo\Process\App\Notification\Data\Notification\NotificationUpdate;
use Nemundo\Process\Group\Type\GroupContentType;

trait NotificationTrait
{

    abstract protected function getMessage();

    protected function sendGroupNotification($groupId)
    {

        $group = new GroupContentType();
        $group->fromGroupId($groupId);
        foreach ($group->getUserIdList() as $userId) {
            $this->sendUserNotification($userId);
        }


    }


    protected function sendUserNotification($userId)
    {

        $data = new Notification();
        $data->toId = $userId;
        $data->contentId = $this->getContentId();
        $data->subject = $this->getSubject();
        $data->message = $this->getMessage();
        $data->save();

    }


    public function saveNotificationIndex()
    {

        $update = new NotificationUpdate();
        $update->subject = $this->getSubject();
        $update->message = $this->getMessage();
        $update->filter->andEqual($update->model->contentId, $this->getContentId());
        $update->update();

    }


}