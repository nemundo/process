<?php


namespace Nemundo\Process\Workflow\Com\Table;


use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Process\Group\Type\GroupContentType;
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
        $workflowReader->model->loadGroupAssignment();
$workflowReader->model->groupAssignment->loadGroupType();
       // $workflowReader->model->groupAssignment->groupType->loadContentType();

        $workflowRow = $workflowReader->getRowById($this->workflowId);

        $model = $workflowReader->model;

        $table = new AdminLabelValueTable($this);
        $table->addLabelValue($model->workflowNumber->label, $workflowRow->workflowNumber);
        $table->addLabelValue($model->subject->label, $workflowRow->subject);
        $table->addLabelValue($model->assignment->label, $workflowRow->assignment->getValue());
        $table->addLabelValue($model->groupAssignment->label, $workflowRow->groupAssignment->group);

        $table->addLabelValue($model->groupAssignment->groupType->label, $workflowRow->groupAssignment->groupType->contentType);

        $ul = new UnorderedList();

        $group= new GroupContentType($workflowRow->groupAssignmentId);
        foreach ($group->getUserList() as $userRow) {
        $ul->addText($userRow->login);
        }
        $table->addLabelCom('Member',$ul);

        $table->addLabelValue($model->status->label, $workflowRow->status->contentType);
        $table->addLabelYesNoValue($model->workflowClosed->label, $workflowRow->workflowClosed);


        if ($workflowRow->deadline !== null) {
            $table->addLabelValue($model->deadline->label, $workflowRow->deadline->getShortDateLeadingZeroFormat());
        }

        $table->addLabelValue($model->dateTime->label, $workflowRow->dateTime->getShortDateTimeLeadingZeroFormat());
        $table->addLabelValue($model->user->label, $workflowRow->user->displayName);




        /*
        $workflowItem = new WorkflowProcess($this->workflowId);

        $table->addLabelValue('Start', $workflowItem->getStart()->getShortDateTimeLeadingZeroFormat());
        $table->addLabelValue('End', $workflowItem->getEnd()->getShortDateTimeLeadingZeroFormat());
        $table->addLabelValue('Durchlaufzeit', $workflowItem->getDurchlaufzeit() . ' Tage');
*/

        return parent::getContent();

    }

}