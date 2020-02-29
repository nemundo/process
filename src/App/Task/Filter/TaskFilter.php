<?php


namespace Nemundo\Process\App\Task\Filter;


use Nemundo\Db\Filter\AbstractFilter;
use Nemundo\Process\App\Assignment\Status\ClosedAssignmentStatus;
use Nemundo\Process\App\Assignment\Status\OpenAssignmentStatus;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexModel;
use Nemundo\Process\App\Task\Parameter\TaskTypeParameter;
use Nemundo\Workflow\App\Workflow\Com\ListBox\Item\ClosedListBoxItem;
use Nemundo\Workflow\App\Workflow\Com\ListBox\Item\OpenListBoxItem;
use Nemundo\Workflow\App\Workflow\Parameter\WorkflowStatusParameter;
use Schleuniger\App\Org\Parameter\VerantwortlicherParameter;

class TaskFilter extends AbstractFilter
{

    protected function loadFilter()
    {

        $model=new TaskIndexModel();

        $parameter=new TaskTypeParameter();
        if ($parameter->hasValue()) {
        $this->andEqual($model->taskTypeId,$parameter->getValue());
        }

        $parameter=new VerantwortlicherParameter();
        if ($parameter->hasValue()) {
            $this->andEqual($model->assignmentId,$parameter->getValue());
        }

        $statusParameter = new WorkflowStatusParameter();
        if ($statusParameter->hasValue()) {

            if ($statusParameter->getValue() == (new OpenListBoxItem())->id) {
                $this->andEqual($model->closed, false);
            }

            if ($statusParameter->getValue() == (new ClosedListBoxItem())->id) {
                $this->andEqual($model->closed, true);
            }
        }

        // TODO: Implement loadFilter() method.
    }

}