<?php


namespace Nemundo\Process\App\Assignment\Content\Group;


use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Process\App\Assignment\Content\AbstractAssignmentContentType;

class AssignmentContentType extends AbstractAssignmentContentType
{

    public $groupId;

    /**
     * @var Date
     */
    public $deadline;

    protected function loadContentType()
    {

        $this->typeLabel = 'Assignment';
        $this->typeId = 'e4368eda-9bb4-4610-9595-7ad9e86272ba';
        $this->formClass = AssignmentForm::class;

        $this->deadline = new Date();

    }

}