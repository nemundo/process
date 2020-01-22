<?php


namespace Nemundo\Process\App\Notification\Content;


use Nemundo\Process\App\Notification\Data\Notification\Notification;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class NotificationContentType extends AbstractTreeContentType
{

    public $userId;

    public $message;

    protected function loadContentType()
    {
     $this->typeLabel='Notification';
     $this->typeId='a03e8d46-ce7d-435b-8ef3-13d7a524b58c';
        // TODO: Implement loadContentType() method.
    }



    protected function onCreate()
    {


        $data=new Notification();
        $data->userId=$this->userId;
        $data->contentId=$this->parentId;
        $data->message =$this->message;
       $this->dataId= $data->save();


    }

}