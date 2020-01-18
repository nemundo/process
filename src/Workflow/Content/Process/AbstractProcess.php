<?php


namespace Nemundo\Process\Workflow\Content\Process;


use Nemundo\Core\Date\DateTimeDifference;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\App\Assignment\Data\Assignment\AssignmentUpdate;
use Nemundo\Process\App\Assignment\Status\CancelAssignmentStatus;
use Nemundo\Process\App\Assignment\Status\OpenAssignmentStatus;
use Nemundo\Process\Content\Data\Content\ContentUpdate;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Content\View\AbstractProcessView;
use Nemundo\Process\Workflow\Data\Workflow\Workflow;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowCount;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowDelete;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowReader;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowRow;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowValue;
use Nemundo\User\Access\UserRestrictionTrait;
use Nemundo\Workflow\App\Identification\Model\Identification;

// AbstractWorkflowProcess
abstract class AbstractProcess extends AbstractSequenceContentType
{

    use UserRestrictionTrait;

    public $number;

    public $workflowNumber;


    /**
     * @var string
     */
    protected $prefixNumber;

    /**
     * @var int
     */
    protected $startNumber=1;


    public $workflowSubject;

    /**
     * @var Identification
     */
    protected $assignment;

    protected $groupAssignmentId;

    protected $deadline;


    public $processViewClass;

    /**
     * @var string
     */
    public $baseViewClass;

    /**
     * @var WorkflowRow
     */
    private $workflowRow;


    public function saveType()
    {

        if ($this->createMode) {

            $this->saveContentBefore();
            $this->onCreate();

            $update = new ContentUpdate();
            $update->dataId = $this->dataId;
            $update->updateById($this->contentId);

        }


        $this->saveTree();
        $this->saveWorkflow();

        $update = new ContentUpdate();
        $update->subject = $this->getSubject();
        $update->updateById($this->contentId);

        $this->saveSearchIndex();
        $this->onFinished();


    }


    protected function saveWorkflow()
    {

        if ($this->number == null) {
            $value = new WorkflowValue();
            $value->field = $value->model->number;
            $value->filter->andEqual($value->model->processId, $this->typeId);
            $this->number = $value->getMaxValue();
            if ($this->number == '') {
                $this->number = $this->startNumber-1;
            }
            $this->number = $this->number + 1;
            $this->workflowNumber = $this->prefixNumber . $this->number;
        }

        $data = new Workflow();
        $data->id = $this->dataId;
        $data->processId = $this->typeId;
        $data->number = $this->number;
        $data->workflowNumber = $this->workflowNumber;
        $data->statusId = $this->startContentType->typeId;
        $data->subject = $this->workflowSubject;
        $data->assignment = $this->assignment;
        $data->dateTime = $this->dateTime;
        $data->userId = $this->userId;
        $data->save();

        $this->addSearchWord($this->workflowNumber);
        $this->addSearchText($this->getSubject());

    }


    public function deleteType()
    {

        parent::deleteType();
        (new WorkflowDelete())->deleteById($this->dataId);
        //$this->deleteChild();

    }


    public function getSubject()
    {

        $workflowRow = (new WorkflowReader())->getRowById($this->dataId);

        $subject = $workflowRow->workflowNumber . ' ' . $workflowRow->subject;
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


    public function getWorkflowRow()
    {

        if ($this->workflowRow == null) {
            $reader = new WorkflowReader();
            $reader->model->loadProcess();
            $reader->model->loadUser();
            $reader->filter->andEqual($reader->model->id, $this->dataId);

            foreach ($reader->getData() as $workflowCustomRow) {
                $this->workflowRow = $workflowCustomRow;
            }

        }

        return $this->workflowRow;

    }


    public function isWorkflowClosed()
    {
        $workflowRow = $this->getWorkflowRow();
        $workflowClosed = false;
        if ($workflowRow !== null) {
            $workflowClosed = $workflowRow->workflowClosed;
        }

        return $workflowClosed;

    }


    public function closeWorkflow()
    {

        $update = new WorkflowUpdate();
        $update->workflowClosed = true;
        $update->updateById($this->dataId);

    }

    public function existWorkflow()
    {

        $value = false;
        $count = new WorkflowCount();
        $count->filter->andEqual($count->model->id, $this->dataId);
        if ($count->getCount() == 1) {
            $value = true;
        }
        return $value;

    }


    public function hasDeadline()
    {

        $value = false;
        $workflowRow = $this->getWorkflowRow();

        if ($workflowRow->deadline !== null) {
            $value = true;
        }

        return $value;
    }


    public function getDeadline()
    {

        $workflowRow = $this->getWorkflowRow();
        return $workflowRow->deadline;
    }

    public function changeDeadline(Date $date = null)
    {

        if ($date !== null) {
            $update = new WorkflowUpdate();
            $update->deadline = $date;
            $update->updateById($this->dataId);

            $update = new AssignmentUpdate();
            $update->deadline = $date;
            $update->filter->andEqual($update->model->sourceId, $this->getContentId());
            $update->filter->andEqual($update->model->statusId, (new OpenAssignmentStatus())->id);
            $update->update();

        }

    }


    public function cancelAssignment()
    {

        $update = new AssignmentUpdate();
        $update->statusId = (new CancelAssignmentStatus())->id;
        $update->filter->andEqual($update->model->sourceId, $this->getContentId());
        $update->update();

    }

    public function changeSubject($subject)
    {

        // change subject status

        $update = new WorkflowUpdate();
        $update->subject = $subject;
        $update->updateById($this->dataId);

    }


    public function changeAssignment(Identification $assignment)
    {


        $update = new WorkflowUpdate();
        $update->assignment = $assignment;
        $update->updateById($this->dataId);

        // Assignment reset
    }


    public function changeGroupAssignment($groupId = null)
    {

        if ($groupId !== null) {
            $update = new WorkflowUpdate();
            $update->groupAssignmentId = $groupId;
            $update->updateById($this->dataId);
        }

    }

    public function clearAssignment()
    {

        $update = new WorkflowUpdate();
        $update->assignment->clearIdentification();
        $update->updateById($this->dataId);

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

        $reader = new TreeReader();
        $reader->model->loadChild();
        $reader->filter->andEqual($reader->model->parentId, $this->getContentId());
        $reader->addOrder($reader->model->id, $sortOrder);
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
    {

        $statusList[] = $status;

        $nextStatus = $status->getNextMenu();
        if ($nextStatus !== null) {
            $statusList = $this->getProcessNextStatus($nextStatus, $statusList);
        }

        return $statusList;

    }


    public function getProcessView(AbstractHtmlContainer $parent)
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