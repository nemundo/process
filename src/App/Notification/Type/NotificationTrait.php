<?php

namespace Nemundo\Process\App\Notification\Type;


use Nemundo\Core\Language\Translation;
use Nemundo\Package\ResponsiveMail\ResponsiveActionMailMessage;
use Nemundo\Process\App\Favorite\Reader\FavoriteUserReader;
use Nemundo\Process\App\Notification\Category\AbstractCategory;
use Nemundo\Process\App\Notification\Category\InformationCategory;
use Nemundo\Process\App\Notification\Data\Notification\Notification;
use Nemundo\Process\App\Notification\Data\Notification\NotificationDelete;
use Nemundo\Process\App\Notification\Data\Notification\NotificationUpdate;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Group\Type\GroupContentType;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\Workflow\App\Notification\Config\NotificationSendMailConfig;

trait NotificationTrait
{

    abstract protected function getMessage();

    protected function sendGroupNotification($groupId, AbstractCategory $category = null)
    {

        $group = new GroupContentType();
        $group->fromGroupId($groupId);
        foreach ($group->getUserIdList() as $userId) {
            $this->sendUserNotification($userId,$category);
        }

    }


    public function sendUserNotification($userId, AbstractCategory $category = null)
    {

        if ($category == null) {
            $category = new InformationCategory();
        }

        $data = new Notification();
        $data->ignoreIfExists=true;
        $data->read = false;
        $data->archive = false;
        $data->categoryId = $category->id;
        $data->toId = $userId;
        $data->contentTypeId = $this->typeId;
        $data->contentId = $this->getContentId();
        $data->subject = $this->getSubject();
        $data->message = $this->getMessage();
        $dataId = $data->save();


        if ((new NotificationSendMailConfig)->getValueByUserId($userId)) {

            $userType = new UserContentType($userId);
            $userRow = $userType->getDataRow();

            $mail = new ResponsiveActionMailMessage();
            $mail->mailTo = $userRow->email;
            $mail->subject = (new Translation())->getText($category->category) . ': ' . $this->getSubject();
            //$mail->subject = 'Benachrichtigung: ' . $this->getSubject();
            //$mail->actionText = $this->getLog();
            $mail->actionText = $this->getMessage();

            //$mail->actionText =$this->getView()->getContent();  //get (new Html($this->getMessage()))->getValue();
            //$mail->actionLabel[LanguageCode::EN] = 'ViewAnsehen';
            $mail->actionLabel = 'Ansehen';
            $mail->actionUrlSite = $this->getViewSite();
            $mail->sendMail();

        }

        return $dataId;

    }


    public function saveNotificationIndex()
    {

        $update = new NotificationUpdate();
        $update->subject = $this->getSubject();
        $update->message = $this->getMessage();
        $update->filter->andEqual($update->model->contentId, $this->getContentId());
        $update->update();

    }


    public function deleteNotification()
    {

        $delete = new NotificationDelete();
        $delete->filter->andEqual($delete->model->contentId, $this->getContentId());
        $delete->delete();

    }



    public function sendFavoriteNotification(AbstractContentType $contentType) {


        foreach ((new FavoriteUserReader($contentType))->getUserList() as $userId) {
            $this->sendUserNotification($userId);
        }


    }



}