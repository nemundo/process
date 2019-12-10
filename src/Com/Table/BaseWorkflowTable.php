<?php


namespace Nemundo\Process\Com\Table;


use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Process\Data\Workflow\WorkflowReader;
use Nemundo\Process\Item\WorkflowItem;

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
        $table->addLabelValue($model->status->label, $workflowRow->status->statusLabel);
        $table->addLabelValue($model->dateTime->label, $workflowRow->dateTime->getShortDateTimeFormat());
        $table->addLabelValue($model->user->label, $workflowRow->user->displayName);
        $table->addLabelYesNoValue($model->workflowClosed->label, $workflowRow->user->displayName);

        $workflowItem = new WorkflowItem($this->workflowId);

        $table->addLabelValue('Start', $workflowItem->getStart()->getShortDateTimeFormat());
        $table->addLabelValue('End', $workflowItem->getEnd()->getShortDateTimeFormat());
        $table->addLabelValue('Durchlaufzeit', $workflowItem->getDurchlaufzeit().' Tage');



        return parent::getContent();

    }

}