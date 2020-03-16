<?php


namespace Nemundo\Process\App\Notification\Parameter;


use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Process\App\Notification\Data\Notification\NotificationUpdate;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class NotificationParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName='notification';
    }


    public function getContentType() {

        $notificationId=$this->getValue();

        $update = new NotificationUpdate();
        $update->read=true;
        $update->updateById($notificationId);

        $reader=new NotificationReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();
        $notificationRow = $reader->getRowById($notificationId);
        $contentType = $notificationRow->getContentType();

        return $contentType;

        //$contentType->getViewSite()->redirect();



    }


}