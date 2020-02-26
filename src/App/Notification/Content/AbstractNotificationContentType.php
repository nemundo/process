<?php


namespace Nemundo\Process\App\Notification\Content;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Core\Type\Text\Html;
use Nemundo\Package\ResponsiveMail\ResponsiveActionMailMessage;
use Nemundo\Process\App\Notification\Data\Notification\Notification;
use Nemundo\Process\App\Notification\Data\Notification\NotificationDelete;
use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Process\App\Notification\Parameter\NotificationParameter;
use Nemundo\Process\App\Notification\Site\NotificationItemSite;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\Process\Text\BoldText;
use Nemundo\Workflow\App\Notification\Config\NotificationConfig;
use Nemundo\Workflow\App\Notification\Config\NotificationSendMailConfig;

abstract class AbstractNotificationContentType extends AbstractTreeContentType
{


    //$notificationContentType;

    public $subjectContentId;

    // to
    public $toUserId;

    public $message;


    public function __construct($dataId = null)
    {
        $this->typeLabel='Notification';

        $this->viewSite=NotificationItemSite::$site;
        $this->parameterClass=NotificationParameter::class;

        parent::__construct($dataId);
    }


    protected function onCreate()
    {

        if ($this->subjectContentId == null) {
            $this->subjectContentId = $this->parentId;
        }

        $this->saveNotification();

        NotificationConfig::$sendMail=false;

        if (NotificationConfig::$sendMail) {

            //if ((new NotificationSendMailConfig)->getValue()) {
            if ((new NotificationSendMailConfig)->getValueByUserId($this->toUserId)) {

                //$userType = new UserItemType($userId);

                (new UserContentType($this->toUserId))->getDataRow()->email;


                $contentType = (new ContentReader())->getRowById($this->subjectContentId)->getContentType();

                $mail = new ResponsiveActionMailMessage();
                $mail->mailTo = (new UserContentType($this->toUserId))->getDataRow()->email;
                $mail->subject = 'Benachrichtigung: ' . $contentType->getSubject();
                $mail->actionText = (new Html($this->message))->getValue();
                $mail->actionLabel = 'Ansehen';
                $mail->actionUrlSite = $contentType->getViewSite();
                $mail->sendMail();

            }

        }


    }


    protected function onDelete()
    {

        (new NotificationDelete())->deleteById($this->dataId);

    }


    protected function saveNotification()
    {


        $data = new Notification();
        $data->toId = $this->toUserId;
        $data->subjectContentId = $this->subjectContentId;
        $data->contentId = $this->getContentId();
        $data->message=$this->message;
       // $data->message = $this->getMessage();
        $this->dataId = $data->save();

    }


    public function getDataRow()
    {
        $reader = new NotificationReader();
        $reader->model->loadContent();
        $reader->model->loadSubjectContent();
        $reader->model->subjectContent->loadContentType();
        $reader->model->content->loadUser();
        $reader->model->loadTo();
        $notificationRow = $reader->getRowById($this->dataId);
        return $notificationRow;
    }

    public function getSubject()
    {

        $subject[LanguageCode::EN] = 'Notification to ' . (new BoldText())->getBold(($this->getDataRow())->to->displayName);
        $subject[LanguageCode::DE] = 'Benachrichtigung an ' . (new BoldText())->getBold(($this->getDataRow())->to->displayName);

        return  (new Translation())->getText($subject);

    }


    public function getMessage()
    {
        return $this->message;
    }


}