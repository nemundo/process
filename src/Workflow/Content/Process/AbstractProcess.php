<?php


namespace Nemundo\Process\Workflow\Content\Process;


use Nemundo\App\Performance\PerformanceStopwatch;
use Nemundo\Core\Date\DateTimeDifference;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Model\Count\ModelDataCount;
use Nemundo\Model\Data\ModelUpdate;
use Nemundo\Model\Value\ModelDataValue;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentUpdate;
use Nemundo\Process\App\Assignment\Status\CancelAssignmentStatus;
use Nemundo\Process\App\Assignment\Status\OpenAssignmentStatus;
use Nemundo\Process\Content\Data\Content\ContentUpdate;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Content\View\AbstractProcessView;
use Nemundo\Process\Workflow\Model\AbstractWorkflowModel;
use Nemundo\ToDo\Data\ToDo\ToDoRow;
use Nemundo\User\Access\UserRestrictionTrait;

// AbstractWorkflowProcess
abstract class AbstractProcess extends AbstractSequenceContentType
{

    use UserRestrictionTrait;

    public $number;

    public $workflowNumber;


    /**
     * @var AbstractWorkflowModel
     */
    protected $workflowModel;


    /**
     * @var string
     */
    protected $prefixNumber;

    /**
     * @var int
     */
    protected $startNumber = 1;


    //public $workflowSubject;

    protected $groupAssignmentId;

    /**
     * @var Date
     */
    protected $deadline;


    public $processViewClass;

    /**
     * @var string
     */
    public $baseViewClass;


    public function saveType()
    {

        // gibt es update bei process?

        if ($this->createMode) {

            $this->saveContentBefore();

            $this->onCreate();

            $update = new ModelUpdate();
            $update->model = $this->workflowModel;
            $update->typeValueList->setModelValue($update->model->number, $this->getNumber());
            $update->typeValueList->setModelValue($update->model->workflowNumber, $this->getWorkflowNumber());
            $update->typeValueList->setModelValue($update->model->statusId, $this->startContentType->typeId);
            $update->typeValueList->setModelValue($update->model->dateTime, $this->dateTime->getIsoDateTimeFormat());
            $update->typeValueList->setModelValue($update->model->userId, $this->userId);
            $update->updateById($this->dataId);

            $update = new ContentUpdate();
            $update->dataId = $this->dataId;
            $update->updateById($this->contentId);

        } else {
            (new LogMessage())->writeError('process no create mode');
        }

        $this->saveTree();

        $update = new ContentUpdate();
        $update->subject = $this->getSubject();
        $update->updateById($this->contentId);

        $this->addSearchWord($this->getSubject());
        $this->saveSearchIndex();

        $this->onFinished();


    }



    protected function getNumber()
    {

        if ($this->number == null) {

            $value = new ModelDataValue();
            $value->model = $this->workflowModel;
            $value->field = $value->model->number;

            $this->number = $value->getMaxValue();

            if ($this->number == '') {
                $this->number = $this->startNumber - 1;
            }
            $this->number = $this->number + 1;
            $this->workflowNumber = $this->prefixNumber . $this->number;
        }

        return $this->number;

    }


    protected function getWorkflowNumber()
    {


        $workflowNumber = $this->prefixNumber . $this->getNumber();
        return $workflowNumber;

    }


    /*
        public function deleteType()
        {

            parent::deleteType();
            (new WorkflowDelete())->deleteById($this->getWorkflowId());
            //$this->deleteChild();

        }*/


    public function getSubject()
    {

        //$workflowRow = $this->getWorkflowRow();
        //$subject = $workflowRow->workflowNumber . ' ' . $workflowRow->subject;

        /** @var ToDoRow $dataRow */
        $dataRow = $this->getDataRow();


        $subject = $dataRow->workflowNumber . ' ' . $dataRow->subject;  // '';
        return $subject;

    }


    /**
     * @return AbstractProcessStatus[]
     */
    public function getProcessStatusList()
    {

        $statusList = $this->getProcessNextStatus($this->startContentType, []);
        return $statusList;

    }


    /*
    public function getWorkflowRow()
    {

        if ($this->workflowRow == null) {
            $reader = new WorkflowReader();
            $reader->model->loadStatus();
            $reader->model->loadContent();
            $reader->model->content->loadUser();
            $reader->filter->andEqual($reader->model->content->dataId, $this->dataId);
            $reader->filter->andEqual($reader->model->content->contentTypeId, $this->typeId);

            foreach ($reader->getData() as $workflowCustomRow) {
                $this->workflowRow = $workflowCustomRow;
            }

        }

        return $this->workflowRow;

    }


    public function getWorkflowId()
    {

        if ($this->workflowId == null) {

            $workflowRow = $this->getWorkflowRow();
            if ($workflowRow !== null) {
                $this->workflowId = $workflowRow->id;
            }
        }

        return $this->workflowId;

    }*/


    public function isWorkflowClosed()
    {
        $workflowRow = $this->getDataRow();  // getWorkflowRow();
        $workflowClosed = false;
        if ($workflowRow !== null) {
            $workflowClosed = $workflowRow->workflowClosed;
        }

        return $workflowClosed;

    }


    public function closeWorkflow()
    {

        $update = new ModelUpdate();
        $update->model = $this->workflowModel;
        $update->typeValueList->setModelValue($update->model->workflowClosed, true);
        $update->updateById($this->dataId);

        /*
                $update = new WorkflowUpdate();
                $update->workflowClosed = true;
                $update->updateById($this->getWorkflowId());
        */

    }


    public function existItem()
    {

        $value = false;
        $count = new ModelDataCount();
        $count->model = $this->workflowModel;
        $count->filter->andEqual($count->model->id, $this->dataId);
        if ($count->getCount() > 0) {
            $value = true;
        }

        return $value;

    }


    /*
    public function existWorkflow()
    {

        $value = false;
        $count = new WorkflowCount();
        $count->filter->andEqual($count->model->id, $this->getWorkflowId());
        if ($count->getCount() == 1) {
            $value = true;
        }
        return $value;

    }*/


    public function hasDeadline()
    {

        $value = false;
        $workflowRow = $this->getDataRow();  // $this->getWorkflowRow();

        if ($workflowRow->deadline !== null) {
            $value = true;
        }

        return $value;
    }


    public function getDeadline()
    {

        $workflowRow = $this->getDataRow();   // getWorkflowRow();
        return $workflowRow->deadline;
    }

    public function changeDeadline(Date $date = null)
    {

        if ($date !== null) {

            $update = new ModelUpdate();
            $update->model = $this->workflowModel;
            $update->typeValueList->setModelValue($update->model->deadline, $date->getIsoDateFormat());
            $update->updateById($this->dataId);

            /*            $update = new WorkflowUpdate();
                        $update->deadline = $date;
                        $update->updateById($this->getWorkflowId());*/

            $update = new AssignmentUpdate();
            $update->deadline = $date;
            $update->filter->andEqual($update->model->sourceId, $this->getContentId());
            $update->filter->andEqual($update->model->statusId, (new OpenAssignmentStatus())->id);
            $update->update();

        }

    }


    // clearAssignment
    public function cancelAssignment()
    {

        $update = new AssignmentUpdate();
        $update->statusId = (new CancelAssignmentStatus())->id;
        $update->filter->andEqual($update->model->sourceId, $this->getContentId());
        $update->update();

    }


    public function changeStatus(AbstractContentType $status)
    {

        $update = new ModelUpdate();
        $update->model = $this->workflowModel;
        $update->typeValueList->setModelValue($update->model->statusId, $status->typeId);
        $update->updateById($this->dataId);

        return $this;


    }

    public function changeSubject($subject)
    {

        $update = new ModelUpdate();
        $update->model = $this->workflowModel;
        $update->typeValueList->setModelValue($update->model->subject, $subject);
        $update->updateById($this->dataId);

    }


    public function changeAssignmentByGroup()
    {

        // by group type
    }


    public function changeAssignment($groupId = null)
    {

        if ($groupId !== null) {

            $update = new ModelUpdate();
            $update->model = $this->workflowModel;
            $update->typeValueList->setModelValue($update->model->assignmentId, $groupId);
            $update->updateById($this->dataId);

        }

    }


    /*
    public function clearAssignment()
    {

        $update = new WorkflowUpdate();
        $update->assignment->clearIdentification();
        $update->updateById($this->dataId);

    }*/


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

        $reader = new TreeReader();
        $reader->model->loadChild();
        $reader->filter->andEqual($reader->model->parentId, $this->getContentId());
        $reader->addOrder($reader->model->id, $sortOrder);
        // $dateTime = $reader->getRow()->child->dateTime;
        $dateTime = $reader->getRow()->child->dateTime;

        return $dateTime;

    }


    //getLeadTimeText();
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


    private function getProcessNextStatus(AbstractProcessStatus $status, $statusList)
        //    private function getProcessNextStatus($status, $statusList)
    {

        $statusList[] = $status;

        $nextStatus = $status->getNextMenu();
        if ($nextStatus !== null) {
            $statusList = $this->getProcessNextStatus($nextStatus, $statusList);
        }

        return $statusList;

    }


    public function getProcessView(AbstractHtmlContainer $parent = null)
    {

        /** @var AbstractProcessView $view */
        $view = new $this->processViewClass($parent);
        $view->contentType = $this;

        if (!$this->createMode) {
            $view->dataId = $this->dataId;
        }

        return $view;

    }


}