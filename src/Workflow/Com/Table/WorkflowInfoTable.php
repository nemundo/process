<?php


namespace Nemundo\Process\Workflow\Com\Table;


use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Process\Group\Com\Span\GroupSpan;
use Nemundo\Process\Workflow\Row\WorkflowCustomRowTrait;


class WorkflowInfoTable extends AdminLabelValueTable
{

    /**
     * @var WorkflowCustomRowTrait
     */
    public $workflowRow;

    public function addDefault()
    {

        $this->addStatus();
        $this->addWorfklowClosed();
        $this->addAssignment();
        $this->addDeadline();
        $this->addCreator();
        $this->addSubject();

    }


    public function addSubject()
    {
        $this->addLabelValue($this->workflowRow->model->subject->label, $this->workflowRow->subject);
        return $this;
    }


    public function addStatus()
    {
        $this->addLabelValue($this->workflowRow->model->status->label, $this->workflowRow->status->contentType->contentType);
        return $this;
    }


    public function addWorfklowClosed()
    {
        $this->addLabelYesNoValue($this->workflowRow->model->workflowClosed->label, $this->workflowRow->workflowClosed);
        return $this;
    }


    public function addAssignment()
    {

        $span = new GroupSpan();
        $span->groupId = $this->workflowRow->assignmentId;
        $span->content = $this->workflowRow->assignment->group;

        $this->addLabelCom($this->workflowRow->model->assignment->label, $span);

        return $this;
    }


    public function addDeadline()
    {

        $text = $this->workflowRow->getDeadline();

        //$this->addLabelValue($this->workflowRow->model->deadline->label, $this->workflowRow->getDeadline());

        return $this;
    }


    public function addCreator()
    {
        $this->addLabelValue('Ersteller', $this->workflowRow->getCreator());
        return $this;
    }

}