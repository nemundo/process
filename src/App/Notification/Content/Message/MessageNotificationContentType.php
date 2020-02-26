<?php


namespace Nemundo\Process\App\Notification\Content\Message;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\App\Notification\Content\AbstractNotificationContentType;

class MessageNotificationContentType extends AbstractNotificationContentType
{

    protected function loadContentType()
    {

        $this->typeLabel=[];
        $this->typeLabel[LanguageCode::EN]='Message Notification';
        $this->typeLabel[LanguageCode::DE]='Benachrichtigung';

        $this->typeId='b0649289-6c54-4d6d-acf1-2666b9b34901';

        $this->formClass= MessageNotificationContentForm::class;

        // TODO: Implement loadContentType() method.
    }




    public function getMessage()
    {

        $notificationRow = $this->getDataRow();
        $message =$notificationRow->message;
        return $message;


    }

}