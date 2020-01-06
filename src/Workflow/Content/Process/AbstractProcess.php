<?php


namespace Nemundo\Process\Workflow\Content\Process;


use Nemundo\Core\Date\DateTimeDifference;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Workflow\Com\Container\BaseWorkflowContainer;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Content\View\ProcessView;
use Nemundo\Process\Workflow\Content\Writer\WorkflowWriter;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowCount;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowDelete;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowReader;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowRow;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;
use Nemundo\Process\Workflow\Parameter\WorkflowParameter;
use Nemundo\Process\Workflow\Site\WorkflowItemSite;
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
    protected $startNumber;


    protected $workflowSubject;

    /**
     * @var Identification
     */
    protected $assignment;


    /**
     * @var string
     */
    public $baseViewClass;

    /**
     * @var WorkflowRow
     */
    private $workflowRow;


    public function __construct($dataId = null)
    {

        $this->viewClass = ProcessView::class;
        $this->baseViewClass = BaseWorkflowContainer::class;
        $this->viewSite = WorkflowItemSite::$site;
        $this->parameterClass = WorkflowParameter::class;
        $this->assignment = new Identification();

        parent::__construct($dataId);


    }


    public function saveType()
    {

        if ($this->createMode) {
            $this->onCreate();
        } else {
            $this->onUpdate();
        }

        $writer = new WorkflowWriter();
        $writer->contentType = $this;
        $writer->prefixNumber=$this->prefixNumber;
        $writer->startNumber=$this->startNumber;
        $writer->parentId = $this->parentId;
        $writer->dataId = $this->dataId;
        $writer->subject = $this->workflowSubject;
        $writer->number=$this->number;
        $writer->workflowNumber=$this->workflowNumber;
        $writer->workflowSubject = $this->workflowSubject;
        $writer->assignment = $this->assignment;
        $writer->dateTime = $this->dateTime;
        $writer->userId = $this->userId;
        $writer->write();


        $this->addSearchWord($writer->workflowNumber);
        $this->addSearchText($this->getSubject());

        $this->saveSearchIndex();

        return $this->dataId;

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


    /*
    public function getForm(AbstractHtmlContainer $parent)
    {

        $form = $this->startStatus->getForm($parent);
        return $form;

    }*/


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
$reader->filter->andEqual($reader->model->id,$this->dataId);

            foreach ($reader->getData() as $workflowCustomRow) {
                $this->workflowRow = $workflowCustomRow;
            }



            //$this->workflowRow =$reader->getRowById($this->dataId);  // $workflowCustomRow;
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

        // Assignment reset

        $update = new WorkflowUpdate();
        $update->workflowClosed = true;
        //$update->verantwortlicher->clearIdentification();
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

    public function changeDeadline(Date $date)
    {

        $update = new WorkflowUpdate();
        $update->deadline = $date;
        $update->updateById($this->dataId);

    }


    public function changeSubject($subject)
    {

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
        $reader->filter->andEqual($reader->model->parentId, $this->dataId);
        $reader->addOrder($reader->model->id, $sortOrder);
        $dateTime = $reader->getRow()->child->dateTime;

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


    private function getProcessNextStatus(AbstractProcessStatus $status, $statusList)
    {

        $statusList[] = $status;

        $nextStatus = $status->getNextMenu();
        if ($nextStatus !== null) {
            $statusList = $this->getProcessNextStatus($nextStatus, $statusList);
        }

        return $statusList;

    }


}