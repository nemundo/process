<?php


namespace App\App\IssueTracker\Notification\Builder;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Package\ResponsiveMail\ResponsiveActionMailMessage;
use Nemundo\Process\App\Notification\Data\Notification\Notification;
use Nemundo\Process\Template\Content\User\UserContentType;

class NotificationBuilder extends AbstractBase
{


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


}