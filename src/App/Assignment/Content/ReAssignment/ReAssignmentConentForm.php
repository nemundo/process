<?php


namespace Nemundo\Process\App\Assignment\Content\ReAssignment;


use Nemundo\Process\App\Assignment\Content\AbstractAssignmentContentForm;

class ReAssignmentConentForm extends AbstractAssignmentContentForm
{

    protected function onSubmit()
    {
        $status = new ReAssignmentContentType();
        $status->parentId = $this->parentId;
        $status->groupId = $this->group->getValue();
        $status->deadline->fromGermanFormat($this->deadline->getValue());
        //$status->message = 'da muesch öbis mache ...';
        $status->saveType();
    }

}