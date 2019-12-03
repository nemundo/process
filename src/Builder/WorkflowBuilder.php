<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Date\DateTimeDifference;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\User\Type\UserSessionType;
use Schleuniger\App\ChangeRequest\Data\Eco\EcoId;
use Schleuniger\App\ChangeRequest\Data\Eco\EcoReader;
use Schleuniger\App\ChangeRequest\Data\Ecr\EcrId;
use Schleuniger\App\ChangeRequest\Data\Ecr\EcrReader;
use Schleuniger\App\ChangeRequest\Data\Workflow\WorkflowReader;
use Schleuniger\App\ChangeRequest\Data\Workflow\WorkflowUpdate;
use Schleuniger\App\ChangeRequest\Data\WorkflowLog\WorkflowLog;
use Schleuniger\App\ChangeRequest\Data\WorkflowLog\WorkflowLogCount;
use Schleuniger\App\ChangeRequest\Data\WorkflowLog\WorkflowLogReader;
use Nemundo\Process\Status\AbstractStatus;


// WorkflowItem
class WorkflowBuilder extends AbstractBase
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
        $update->abgeschlossen = true;
        $update->verantwortlicher->clearIdentification();
        $update->updateById($this->workflowId);


    }


    public function getEcrRow()
    {


        $ecrReader = new EcrReader();
        $ecrReader->model->loadAnlage();
        $ecrReader->model->loadWorkflow();
        $ecrReader->filter->andEqual($ecrReader->model->workflowId, $this->workflowId);
        $ecrRow = $ecrReader->getRow();

        return $ecrRow;


    }


    public function getEcoRow()
    {

        $ecoReader = new EcoReader();
        $ecoReader->model->loadWorkflow();
        $ecoReader->filter->andEqual($ecoReader->model->workflowId, $this->workflowId);
        $ecrRow = $ecoReader->getRow();

        return $ecrRow;

    }


    public function getEcrId()
    {

        $id = new EcrId();
        $id->filter->andEqual($id->model->workflowId, $this->workflowId);
        $ecrId = $id->getId();

        return $ecrId;

    }


    public function getEcoId()
    {


        $id = new EcoId();
        $id->filter->andEqual($id->model->workflowId, $this->workflowId);
        $ecoId = $id->getId();

        return $ecoId;

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
            $dateTime = (new DateTime())->setNow();  //->resetTime();


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

    }

}