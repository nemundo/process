<?php


namespace Nemundo\Process\App\Assignment\Content\ReAssignment;


use Nemundo\Process\App\Assignment\Content\AbstractAssignmentContentForm;
use Nemundo\Process\App\Assignment\Content\AbstractAssignmentContentType;

class ReAssignmentConentForm extends AbstractAssignmentContentForm
{

    /**
     * @var AbstractAssignmentContentType
     */
    public $contentType;

    protected function onSubmit()
    {


        $this->contentType->groupId=  $this->group->getValue();
        $this->contentType->deadline->fromGermanFormat($this->deadline->getValue());
        //$status->message = 'da muesch öbis mache ...';
        $this->contentType->saveType();


        /*
        $status = new ReAssignmentContentType();
        $status->parentId = $this->parentId;
        $status->groupId = $this->group->getValue();
        $status->deadline->fromGermanFormat($this->deadline->getValue());
        //$status->message = 'da muesch öbis mache ...';
        $status->saveType();*/



    }

}