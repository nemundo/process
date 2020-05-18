<?php


namespace Nemundo\Process\App\Task\Filter;


use Nemundo\Db\Filter\AbstractFilter;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexModel;
use Nemundo\Process\App\Task\Parameter\TaskTypeParameter;
use Nemundo\User\Parameter\UserParameter;
use Nemundo\Workflow\App\Workflow\Com\ListBox\Item\ClosedListBoxItem;
use Nemundo\Workflow\App\Workflow\Com\ListBox\Item\OpenListBoxItem;
use Nemundo\Workflow\App\Workflow\Parameter\WorkflowStatusParameter;

class TaskFilter extends AbstractFilter
{

    protected $model;

    protected function loadFilter()
    {

        $this->model = new TaskIndexModel();

        $parameter = new TaskTypeParameter();
        if ($parameter->hasValue()) {
            $this->andEqual($this->model->taskTypeId, $parameter->getValue());
        }

        $parameter = new UserParameter();
        if ($parameter->hasValue()) {
            $this->andEqual($this->model->userId, $parameter->getValue());
        }

        $statusParameter = new WorkflowStatusParameter();
        if ($statusParameter->hasValue()) {

            if ($statusParameter->getValue() == (new OpenListBoxItem())->id) {
                $this->andEqual($this->model->closed, false);
            }

            if ($statusParameter->getValue() == (new ClosedListBoxItem())->id) {
                $this->andEqual($this->model->closed, true);
            }
        }

    }

}