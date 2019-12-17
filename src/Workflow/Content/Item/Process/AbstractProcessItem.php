<?php


namespace Nemundo\Process\Workflow\Content\Item\Process;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Date\DateTimeDifference;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Db\Sql\Order\SortOrder;

use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Workflow\Content\Item\Status\DateTimeUserIdStatusItem;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Content\Status\AbstractStatus;
use Nemundo\Process\Workflow\Data\Process\ProcessId;
use Nemundo\Process\Workflow\Data\Status\StatusId;
use Nemundo\Process\Workflow\Data\Workflow\Workflow;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowReader;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;

use Nemundo\Process\Workflow\Data\Workflow\WorkflowValue;
use Nemundo\Workflow\App\Identification\Model\Identification;

// WorkflowItem
abstract class AbstractProcessItem extends AbstractContentItem
{

    /**
     * @var AbstractProcess
     */
    public $contentType;

    /**
     * @var int
     */
    protected $number;

    /**
     * @var string
     */
    protected $workflowNumber;

    protected $subject = '[no subject]';

    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * @var string
     */
    protected $userId;

    /**
     * @var Identification
     */
    protected $assignment;

    /**
     * @var string
     */
    //protected $workflowId;

    /*public function __construct($workflowId)
    {

        $this->workflowId = $workflowId;

    }*/






    protected function saveWorkflow()
    {

        $id = new ProcessId();
        $id->filter->andEqual($id->model->contentTypeId, $this->contentType->id);
        $processId = $id->getId();


        if ($this->number == null) {
            $value = new WorkflowValue();
            $value->field = $value->model->number;
            $value->filter->andEqual($value->model->processId, $processId);  // $this->process->id);
            $this->number = $value->getMaxValue();
            if ($this->number == "") {
                $this->number = $this->contentType->startNumber;
            }
            $this->number = $this->number + 1;

            $this->workflowNumber = $this->contentType->prefixNumber . $this->number;
        }


        //(new Debug())->write('process');
        //(new Debug())->write('start id '.$this->process->startStatus->id);

        $id = new StatusId();
        $id->filter->andEqual($id->model->contentTypeId, $this->contentType->startStatus->id);
        $stausId = $id->getId();


        $data = new Workflow();
        $data->processId = $processId;  // $this->process->id;
        $data->number = $this->number;
        $data->workflowNumber = $this->workflowNumber;
        $data->statusId = $stausId;  // $this->process->startStatus->id;
        $data->subject = $this->subject;
        $data->assignment = $this->assignment;
        $data->dateTime = $this->dateTime;
        $data->userId = $this->userId;
        $this->dataId = $data->save();


        $this->saveContent();


        $builder = new DateTimeUserIdStatusItem();
        $builder->parentId = $this->dataId;
        $builder->contentType = $this->contentType->startStatus;
        $builder->dateTime = $this->dateTime;
        $builder->userId = $this->userId;
        $builder->saveItem();




    }



    public function closeWorkflow()
    {

        // Assignment reset

        $update = new WorkflowUpdate();
        $update->workflowClosed = true;
        //$update->verantwortlicher->clearIdentification();
        $update->updateById($this->dataId);

    }


    public function changeStatus(AbstractStatus $status)
    {

        $update = new WorkflowUpdate();
        $update->statusId = $status->id;
        $update->updateById($this->dataId);

    }


    public function changeAssignment(Identification $assignment) {


        $update = new WorkflowUpdate();
        $update->assignment = $assignment;
        $update->updateById($this->dataId);

        // Assignment reset
    }



    public function changeDeadline(Date $date) {

        $update = new WorkflowUpdate();
        $update->deadline =$date;
        $update->updateById($this->dataId);



    }


    /*
    public function logStatus(AbstractStatusLogBuilder $statusBuilder) {

    }*/



    public function getWorkflowRow()
    {

        $workflowRow = (new WorkflowReader())->getRowById($this->dataId);
        return $workflowRow;

    }


    // getWorkflowHistory
   /*public function getWorkflowLog()
    {


        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->model->loadUserCreated();
        $reader->filter->andEqual($reader->model->parentId, $this->workflowId);
        $reader->addOrder($reader->model->itemOrder);

        return $reader->getData();

        /*
                $reader = new WorkflowLogReader();
                $reader->model->loadStatus();
                $reader->model->loadUser();

                $reader->filter->andEqual($reader->model->workflowId, $this->workflowId);
                $reader->addOrder($reader->model->id);
                return $reader->getData();*/



    //}


    public function getStart()
    {

        $dateTime = $this->getDateTime(SortOrder::ASCENDING);
        return $dateTime;

    }


    public function getEnd()
    {


        $dateTime = null;
        if ($this->getWorkflowRow()->workflowClosed) {

            $dateTime = $this->getDateTime(SortOrder::DESCENDING);

        } else {
            $dateTime = (new DateTime())->setNow();
        }

        return $dateTime;

    }


    private function getDateTime($sortOrder)
    {

        $reader = new ContentReader();
        $reader->filter->andEqual($reader->model->parentId, $this->dataId);
        $reader->addOrder($reader->model->id, $sortOrder);
        $dateTime = $reader->getRow()->dateTimeCreated;

        return $dateTime;

    }


    // getLeapTime
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



}