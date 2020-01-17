<?php


namespace Nemundo\Process\App\Assignment\Content\Message;


use Nemundo\Process\App\Assignment\Content\AbstractAssignmentContentType;


class MessageAssignmentContentType extends AbstractAssignmentContentType
{

    public $message;

    protected function loadContentType()
    {
        $this->typeLabel = 'Message Assignment';
        $this->typeId = 'a9e5ac85-fc85-4bdb-9872-8d8a2462f124';
        $this->formClass = MessageAssignmentContentForm::class;
    }


    protected function onCreate()
    {

        $this->assignAssignment();

    }


    public function getMessage()
    {

        return $this->message;

    }


}