<?php


namespace Nemundo\Process\App\Assignment\Content\Assignment;


use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Package\Bootstrap\FormElement\BootstrapDatePicker;
use Nemundo\Process\Group\Com\ListBox\GroupListBox;
use Nemundo\Process\Group\Com\ListBox\GroupTypeListBox;
use Nemundo\Process\Workflow\Content\Form\AbstractStatusForm;

class AssignmentForm extends AbstractStatusForm
{

    /**
     * @var GroupTypeListBox
     */
    private $groupType;

    /**
     * @var GroupListBox
     */
    private $group;

    /**
     * @var BootstrapDatePicker
     */
    private $deadline;

    public function getContent()
    {

        $this->group = new GroupListBox($this);
        $this->group->validation = true;

        $this->deadline = new BootstrapDatePicker($this);
        $this->deadline->label = 'Datum';
        $this->deadline->value = (new Date())->setNow()->getShortDateLeadingZeroFormat();
        //$this->datum->validation = true;

        return parent::getContent();

    }


    protected function onSubmit()
    {

        $status = new AssignmentContentType();
        $status->parentId = $this->parentId;
        $status->groupId = $this->group->getValue();
        $status->deadline->fromGermanFormat($this->deadline->getValue());
        //$status->message = 'da muesch öbis mache ...';
        $status->saveType();

    }


}