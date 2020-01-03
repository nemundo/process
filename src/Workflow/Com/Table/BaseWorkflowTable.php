<?php


namespace Nemundo\Process\Workflow\Com\Table;


use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Process\Workflow\Content\Item\Process\WorkflowItem;
use Nemundo\Process\Workflow\Content\Process\WorkflowProcess;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowReader;

class BaseWorkflowTable extends AdminLabelValueTable
{

    public $workflowId;

    public function getContent()
    {

        $workflowReader = new WorkflowReader();
        $workflowReader->model->loadUser();
        $workflowReader->model->loadStatus();
        $workflowRow = $workflowReader->getRowById($this->workflowId);

        $model = $workflowReader->model;

        $table = new AdminLabelValueTable($this);
        $table->addLabelValue($model->workflowNumber->label, $workflowRow->workflowNumber);
        $table->addLabelValue($model->subject->label, $workflowRow->subject);
        $table->addLabelValue($model->assignment->label, $workflowRow->assignment->getValue());
        $table->addLabelValue($model->status->label, $workflowRow->status->contentType);
        $table->addLabelYesNoValue($model->workflowClosed->label, $workflowRow->workflowClosed);

        $table->addLabelValue($model->dateTime->label, $workflowRow->dateTime->getShortDateTimeFormat());
        $table->addLabelValue($model->user->label, $workflowRow->user->displayName);

        if ($workflowRow->deadline !== null) {
            $table->addLabelValue($model->deadline->label, $workflowRow->deadline->getShortDateLeadingZeroFormat());
        }

        $workflowItem = new WorkflowProcess($this->workflowId);

        $table->addLabelValue('Start', $workflowItem->getStart()->getShortDateTimeFormat());
        $table->addLabelValue('End', $workflowItem->getEnd()->getShortDateTimeFormat());
        $table->addLabelValue('Durchlaufzeit', $workflowItem->getDurchlaufzeit() . ' Tage');


        return parent::getContent();

    }

}