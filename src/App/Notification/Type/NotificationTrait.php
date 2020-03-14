<?php

namespace Nemundo\Process\App\Notification\Type;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Type\Text\Html;
use Nemundo\Package\ResponsiveMail\ResponsiveActionMailMessage;
use Nemundo\Process\App\Notification\Data\Notification\Notification;
use Nemundo\Process\App\Notification\Data\Notification\NotificationDelete;
use Nemundo\Process\App\Notification\Data\Notification\NotificationUpdate;
use Nemundo\Process\Group\Type\GroupContentType;
use Nemundo\Process\Template\Content\User\UserContentType;

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
        $data->read=false;
        $data->archive=false;
        $data->toId = $userId;
        $data->contentTypeId=$this->typeId;
        $data->contentId = $this->getContentId();
        $data->subject = $this->getSubject();
        $data->message = $this->getMessage();
        $data->save();


        $userType = new UserContentType($userId);
        $userRow = $userType->getDataRow();


        $mail = new ResponsiveActionMailMessage();
        $mail->mailTo = $userRow->email;
        $mail->subject = $this->getSubject();
        $mail->actionText =$this->getView()->getContent();  //get (new Html($this->getMessage()))->getValue();
        //$mail->actionLabel[LanguageCode::EN] = 'ViewAnsehen';
        $mail->actionLabel = 'Ansehen';
        $mail->actionUrlSite = $this->getViewSite();
        $mail->sendMail();




    }


    public function saveNotificationIndex()
    {

        $update = new NotificationUpdate();
        $update->subject = $this->getSubject();
        $update->message = $this->getMessage();
        $update->filter->andEqual($update->model->contentId, $this->getContentId());
        $update->update();

    }


    public function deleteNotification() {

        $delete = new NotificationDelete();
        $delete->filter->andEqual($delete->model->contentId, $this->getContentId());
        $delete->delete();


    }


}