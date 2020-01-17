<?php


namespace Nemundo\Process\App\Assignment\Content\ReAssignment;


use Nemundo\Process\App\Assignment\Content\AbstractAssignmentContentType;

class ReAssignmentContentType extends AbstractAssignmentContentType
{

    protected function loadContentType()
    {
        $this->typeLabel = 'Re-Assignment';
        $this->typeId = '45635542-fd56-41a8-82f8-1b77fd7ab683';
        $this->formClass = ReAssignmentConentForm::class;
    }


    protected function onCreate()
    {

        $this->cancelAssignment();
        $this->assignAssignment();

    }


    public function getMessage()
    {
        $message = 'Re Assign';
        return $message;
    }

}