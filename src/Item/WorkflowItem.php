<?php


namespace Nemundo\Process\Item;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Date\DateTimeDifference;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Process\Data\Workflow\WorkflowReader;
use Nemundo\Process\Data\Workflow\WorkflowUpdate;
use Nemundo\Process\Data\WorkflowLog\WorkflowLogCount;
use Nemundo\Process\Data\WorkflowLog\WorkflowLogReader;
use Nemundo\User\Type\UserSessionType;
use Nemundo\Process\Status\AbstractStatus;


// WorkflowItem
class WorkflowItem extends AbstractBase
{

    private $workflowId;

    public function __construct($workflowId)
    {

        $this->workflowId = $workflowId;

    }


    public function closeWorkflow()
    {


        // Assignment reset

        $update = new WorkflowUpdate();
        $update->workflowClosed = true;
        //$update->verantwortlicher->clearIdentification();
        $update->updateById($this->workflowId);


    }



    public function getWorkflowRow()
    {

        $workflowRow = (new WorkflowReader())->getRowById($this->workflowId);
        return $workflowRow;

    }


    public function getStart()
    {

        $dateTime = $this->getDateTime(SortOrder::ASCENDING);
        return $dateTime;

    }


    public function getEnd()
    {


        $dateTime = null;
        if ($this->getWorkflowRow()->abgeschlossen) {

            $dateTime = $this->getDateTime(SortOrder::DESCENDING);

        } else {
            $dateTime = (new DateTime())->setNow();
        }

        return $dateTime;

    }


    private function getDateTime($sortOrder)
    {

        $reader = new WorkflowLogReader();
        $reader->filter->andEqual($reader->model->workflowId, $this->workflowId);
        $reader->addOrder($reader->model->id, $sortOrder);
        $dateTime = $reader->getRow()->dateTime;

        return $dateTime;

    }


    public function getDurchlaufzeit()
    {

        $difference = new DateTimeDifference();
        $difference->dateFrom = $this->getStart();
        //$difference->dateFrom->resetTime();
        $difference->dateUntil = $this->getEnd();

        $day = $difference->getDifferenceInDay();

        return $day;


    }


    public function getLogCount()
    {

        $count = new WorkflowLogCount();
        $count->filter->andEqual($count->model->workflowId, $this->workflowId);

        return $count->getCount();

    }


    /*
    public function saveLog(AbstractStatus $status, $dataId = null)
    {

        $status->saveStatus();

        $data = new WorkflowLog();
        $data->statusId = $status->id;
        $data->workflowId = $this->workflowId;
        $data->dataId = $dataId;
        $data->mitarbeiterId = (new UserSessionType())->userId;
        $data->dateTime = (new DateTime())->setNow();
        $workflowLogId = $data->save();

        $workflowRow = (new WorkflowBuilder($this->workflowId))->getWorkflowRow();

        if (!$workflowRow->abgeschlossen) {

            if ($status->changeStatus) {

                $update = new WorkflowUpdate();
                $update->statusId = $status->id;
                $update->updateById($this->workflowId);

            }
        }

        return $workflowLogId;

    }*/

}