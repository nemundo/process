<?php


namespace Nemundo\Process\App\Message\Type;


use Nemundo\App\Content\Form\AbstractContentTreeForm;
use Nemundo\Process\App\Notification\Type\NotificationTrait;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class MessageContentType extends AbstractTreeContentType
{

    use NotificationTrait;

    public $toId;

    public $subject;

    public $message;

    protected function loadContentType()
    {

        $this->typeLabel='Message';
        $this->typeId='58875a89-4dc2-48f2-aa32-6179dedcc841';

        // TODO: Implement loadContentType() method.
    }


    public function getMessage()
    {
        // TODO: Implement getMessage() method.
    }

}