<?php


namespace Nemundo\Process\App\Notification\Content\Weiterleiten;


use Nemundo\Process\App\Notification\Type\NotificationTrait;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class ForwardContentType extends AbstractTreeContentType
{

    use NotificationTrait;

    public $userToId;

    protected function loadContentType()
    {
        // TODO: Implement loadContentType() method.

        $this->formClass=ForwardContentForm::class;

    }

    protected function onCreate()
    {

        $this->sendUserNotification($this->userToId);

    }


    public function getMessage()
    {
        // TODO: Implement getMessage() method.
    }

}