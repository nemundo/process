<?php


namespace Nemundo\Process\Item;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Date\DateTimeDifference;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Process\Builder\AbstractStatusLogBuilder;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Data\Workflow\WorkflowReader;
use Nemundo\Process\Data\Workflow\WorkflowUpdate;
use Nemundo\Process\Data\WorkflowLog\WorkflowLogCount;
use Nemundo\Process\Data\WorkflowLog\WorkflowLogReader;
use Nemundo\User\Type\UserSessionType;
use Nemundo\Process\Status\AbstractStatus;
use Nemundo\Workflow\App\Identification\Model\Identification;

// Abstract
// WorkflowItem
class WorkflowItem extends AbstractBase
{

    /**
     * @var string
     */
    protected $workflowId;

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


    public function changeStatus(AbstractStatus $status)
    {


        $update = new WorkflowUpdate();
        $update->statusId = $status->id;
        $update->updateById($this->workflowId);

    }


    public function changeAssignment(Identification $assignment) {


        $update = new WorkflowUpdate();
        $update->assignment = $assignment;
        $update->updateById($this->workflowId);

        // Assignment reset
    }



    public function changeDeadline(Date $date) {

        $update = new WorkflowUpdate();
        $update->deadline =$date;
        $update->updateById($this->workflowId);



    }


    public function logStatus(AbstractStatusLogBuilder $statusBuilder) {

    }



    public function getWorkflowRow()
    {

        $workflowRow = (new WorkflowReader())->getRowById($this->workflowId);
        return $workflowRow;

    }


    // getWorkflowHistory
   public function getWorkflowLog()
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



    }


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

/*        $reader = new WorkflowLogReader();
        $reader->filter->andEqual($reader->model->workflowId, $this->workflowId);
        $reader->addOrder($reader->model->id, $sortOrder);
        $dateTime = $reader->getRow()->dateTime;*/

        $reader = new ContentReader();
        $reader->filter->andEqual($reader->model->parentId, $this->workflowId);
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