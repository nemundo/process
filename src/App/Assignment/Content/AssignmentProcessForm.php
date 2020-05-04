<?php


namespace Nemundo\Process\App\Assignment\Content;


use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Group\Com\ListBox\AllGroupTypeListBox;
use Nemundo\Process\Group\Com\ListBox\GroupTypeListBox;
use Nemundo\Process\Group\Com\ListBox\MultiGroupListBox;


class AssignmentProcessForm extends AbstractContentForm
{

    /**
     * @var AssignmentProcessStatus
     */
    public $contentType;

    /**
     * @var MultiGroupListBox
     */
    private $groupType;

    public function getContent()
    {

        $this->groupType= new AllGroupTypeListBox($this);
        //$this->groupType->addGroupType(new GeschaeftsbereichContentType());


        return parent::getContent();

    }


    protected function onSubmit()
    {

        $this->contentType->groupId = $this->groupType->getValue();
        $this->contentType->saveType();

    }

}