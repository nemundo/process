<?php


namespace Nemundo\Process\Workflow\Content\Process;


use Nemundo\Core\Date\DateTimeDifference;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Model\Count\ModelDataCount;
use Nemundo\Model\Data\ModelUpdate;
use Nemundo\Model\Value\ModelDataValue;
use Nemundo\Process\App\Calendar\Type\CalendarIndexTrait;
use Nemundo\Process\App\Document\Index\DocumentIndexTrait;
use Nemundo\Process\App\Favorite\Type\FavoriteIndexTrait;
use Nemundo\Process\App\Notification\Type\NotificationTrait;
use Nemundo\Process\App\Task\Index\TaskIndexTrait;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Group\Check\GroupRestrictedTrait;
use Nemundo\Process\Log\Type\LogTrait;
use Nemundo\Process\Template\Status\WorkflowDelete\WorkflowDeleteStatus;
use Nemundo\Process\Template\Status\WorkflowRestore\WorkflowRestoreStatus;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Content\View\AbstractProcessView;
use Nemundo\Process\Workflow\Content\View\ProcessView;
use Nemundo\Process\Workflow\Model\AbstractWorkflowModel;
use Nemundo\ToDo\Data\ToDo\ToDoRow;

// AbstractWorkflowProcess
abstract class AbstractProcess extends AbstractSequenceContentType
{

    use GroupRestrictedTrait;
    use TaskIndexTrait;
    use DocumentIndexTrait;
    use CalendarIndexTrait;
    //use LogTrait;
    use FavoriteIndexTrait;
    use NotificationTrait;

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


    //protected $groupAssignmentId;

    /**
     * @var Date
     */
    //protected $deadline;


    public $processViewClass;

    /**
     * @var string
     */
    public $baseViewClass;

    // workflowDefaultTitle
    public $defaultTitle = 'New';

    /**
     * @var bool
     */
    public $showSource = true;

    public $showReopenButton = false;


    public function __construct($dataId = null)
    {

        $this->processViewClass = ProcessView::class;
        //$this->deadline = new Date();

        parent::__construct($dataId);
    }


    protected function onReopen()
    {

    }


    public function reopenWorkflow()
    {

        $this->onReopen();

        $update = new ModelUpdate();
        $update->model = $this->workflowModel;
        $update->typeValueList->setModelValue($update->model->workflowClosed, false);
        $update->updateById($this->dataId);

        $this->saveIndex();

    }


    protected function onIndex()
    {

        parent::onIndex();

        $this->saveContentIndex();
        $this->saveFavoriteIndex();

        $this->addSearchWord($this->getSubject());
        $this->addSearchWord($this->getDataRow()->workflowNumber);
        $this->saveSearchIndex();

        $this->saveTaskIndex();
        $this->saveDocumentIndex();
        $this->saveNotificationIndex();

    }


    protected function onDelete()
    {

        parent::onDelete();

        $this->deleteTaskIndex();
        $this->deleteDocumentIndex();

    }


    public function saveType()
    {


        $this->onCreate();

        $update = new ModelUpdate();
        $update->model = $this->workflowModel;
        $update->typeValueList->setModelValue($update->model->active, true);
        $update->typeValueList->setModelValue($update->model->number, $this->getNumber());
        $update->typeValueList->setModelValue($update->model->workflowNumber, $this->getWorkflowNumber());
        $update->typeValueList->setModelValue($update->model->statusId, $this->startContentType->typeId);
        $update->typeValueList->setModelValue($update->model->dateTime, $this->dateTime->getIsoDateTimeFormat());
        $update->typeValueList->setModelValue($update->model->userId, $this->userId);
        $update->updateById($this->dataId);

        $this->saveContent();
        $this->saveTree();

        $update = new ModelUpdate();
        $update->model = $this->workflowModel;
        $update->typeValueList->setModelValue($update->model->contentId, $this->getContentId());
        $update->updateById($this->dataId);

        $this->saveContentIndex();
        $this->onFinished();

        $this->onDataRow();

        /** @var ToDoRow $dataRow */
        $dataRow = $this->getDataRow();
        $this->addSearchWord($dataRow->workflowNumber);

        $this->saveIndex();
        $this->saveSearchIndex();

    }


    protected function getNumber()
    {

        if ($this->number == null) {

            $count = new ModelDataCount();
            $count->model = $this->workflowModel;
            $count->filter->andIsNotNull($count->model->number);

            $lastNumber = null;
            if ($count->getCount() === 0) {
                $lastNumber = $this->startNumber;
            } else {

                $value = new ModelDataValue();
                $value->model = $this->workflowModel;
                $value->field = $value->model->number;

                $lastNumber = $value->getMaxValue();

            }

            $this->number = $lastNumber + 1;
            $this->workflowNumber = $this->prefixNumber . $this->number;

        }

        return $this->number;

    }


    protected function getWorkflowNumber()
    {

        $workflowNumber = $this->prefixNumber . $this->getNumber();
        return $workflowNumber;

    }


    /**
     * @return \Nemundo\Model\Row\AbstractModelDataRow|ToDoRow
     */
    public function getDataRow()
    {
        return parent::getDataRow(); // TODO: Change the autogenerated stub
    }


    public function getSubject()
    {

        /** @var ToDoRow $dataRow */
        $dataRow = $this->getDataRow();

        $subject = $dataRow->workflowNumber . ' ' . $dataRow->subject;

        if (!$this->getDataRow()->active) {
            $subject.=' (Gelöscht)';
        }


        return $subject;

    }


    public function getMessage()
    {
        return $this->getSubject();
    }


    protected function getDate()
    {
        return $this->getDeadline();
    }


    protected function getAssignmentId()
    {
        return $this->getDataRow()->assignmentId;
    }


    protected function getDeadline()
    {
        return $this->getDataRow()->deadline;
    }


    protected function isActive()
    {
        return $this->getDataRow()->active;
    }

    protected function isTaskClosed()
    {
        return $this->getDataRow()->workflowClosed;
    }


    protected function getCreatedUserId()
    {
        return $this->getDataRow()->userId;
    }


    protected function getCreatedDateTime()
    {
        return $this->getDataRow()->dateTime;
    }


    /**
     * @return AbstractProcessStatus[]
     */
    public function getProcessStatusList()
    {

        $statusList = $this->getProcessNextStatus($this->startContentType, []);
        return $statusList;

    }


    public function isWorkflowOpen()
    {
        return !$this->isWorkflowClosed();
    }

    public function isWorkflowClosed()
    {

        $workflowClosed = false;

        if ($this->dataId !== null) {
            $workflowRow = $this->getDataRow();
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

    }


    protected function onActive()
    {

        $status = new WorkflowRestoreStatus();
        $status->parentId = $this->getContentId();
        $status->saveType();

        $update = new ModelUpdate();
        $update->model = $this->workflowModel;
        $update->typeValueList->setModelValue($update->model->active, true);
        $update->updateById($this->dataId);

        $this->saveIndex();

    }


    protected function onInactive()
    {

        $status = new WorkflowDeleteStatus();
        $status->parentId = $this->getContentId();
        $status->saveType();

        $update = new ModelUpdate();
        $update->model = $this->workflowModel;
        $update->typeValueList->setModelValue($update->model->active, false);
        $update->updateById($this->dataId);

        $this->deleteNotification();
        foreach ($this->getChildContentTypeList() as $child) {
            $child->deleteNotification();
        }

        $this->saveIndex();

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


    public function hasDeadline()
    {

        $value = false;
        $workflowRow = $this->getDataRow();

        if ($workflowRow->deadline !== null) {
            $value = true;
        }

        return $value;
    }


    public function changeDeadline(Date $deadline = null)
    {

        if ($deadline !== null) {

            $update = new ModelUpdate();
            $update->model = $this->workflowModel;
            $update->typeValueList->setModelValue($update->model->deadline, $deadline->getIsoDateFormat());
            $update->updateById($this->dataId);

            $this->saveIndex();

        }

    }


    public function closeAssignment()
    {

        $update = new ModelUpdate();
        $update->model = $this->workflowModel;
        $update->typeValueList->setModelValue($update->model->assignmentId, 0);
        $update->updateById($this->dataId);

        $this->saveIndex();

    }

    // clearAssignment
   /* public function cancelAssignment()
    {

        // z.B. bei Verbesserung

        //(new Debug())->write('cancel assignment');

        // bei Absenz Abbruch

        //(new Debug())->write('cancel Assignment');

        /* $update = new AssignmentUpdate();
         $update->statusId = (new CancelAssignmentStatus())->id;
         $update->filter->andEqual($update->model->sourceId, $this->getContentId());
         $update->update();*/

    //}


    public function changeStatus(AbstractContentType $status)
    {

        $update = new ModelUpdate();
        $update->model = $this->workflowModel;
        $update->typeValueList->setModelValue($update->model->statusId, $status->getContentId());
        $update->updateById($this->dataId);

        return $this;

    }


    public function changeSubject($subject)
    {

        $update = new ModelUpdate();
        $update->model = $this->workflowModel;
        $update->typeValueList->setModelValue($update->model->subject, $subject);
        $update->updateById($this->dataId);

        $this->saveIndex();

    }


    /*
    public function changeAssignmentByGroup()
    {

        // by group type
    }*/


    public function changeAssignment($groupId = null)
    {

        if ($groupId !== null) {

            $update = new ModelUpdate();
            $update->model = $this->workflowModel;
            $update->typeValueList->setModelValue($update->model->assignmentId, $groupId);
            $update->updateById($this->dataId);

        }

    }


    public function getStartDateTime()
    {

       // $dateTime = $this->getDateTime(SortOrder::ASCENDING);
       $dateTime=$this->getDataRow()->dateTime;
        return $dateTime;

    }


    public function getEndDateTime()
    {

        $dateTime = null;
        if ($this->getDataRow()->workflowClosed) {
            //$dateTime = $this->getDateTime(SortOrder::DESCENDING);

            $reader = new TreeReader();
            $reader->model->loadChild();
            $reader->filter->andEqual($reader->model->parentId, $this->getContentId());
            //$reader->addOrder($reader->model->id, SortOrder::DESCENDING);
            $reader->addOrder($reader->model->child->dateTime, SortOrder::DESCENDING);

            //$reader->addOrder($reader->model->daid, $sortOrder);

            // $dateTime = $reader->getRow()->child->dateTime;
            $dateTime = $reader->getRow()->child->dateTime;

        } else {
            $dateTime = (new DateTime())->setNow();
        }

        return $dateTime;

    }


    /*
    private function getDateTime($sortOrder)
    {

        $reader = new TreeReader();
        $reader->model->loadChild();
        $reader->filter->andEqual($reader->model->parentId, $this->getContentId());
        $reader->addOrder($reader->model->id, $sortOrder);
        $reader->addOrder($reader->model->child->dateTime, $sortOrder);

        //$reader->addOrder($reader->model->daid, $sortOrder);

        // $dateTime = $reader->getRow()->child->dateTime;
        $dateTime = $reader->getRow()->child->dateTime;

        return $dateTime;

    }*/


    public function getLeadTime()
    {

        $difference = new DateTimeDifference();
        $difference->dateFrom = $this->getStartDateTime();
        $difference->dateUntil = $this->getEndDateTime();
        $day = $difference->getDifferenceInDay();

        return $day;

    }


    public function getLeadTimeText()
    {

        $text = $this->getLeadTime() . ' Tage';
        return $text;

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


    public function getProcessView(AbstractHtmlContainer $parent = null)
    {

        /** @var AbstractProcessView $view */
        $view = new $this->processViewClass($parent);
        $view->contentType = $this;

        return $view;

    }


    public function getBaseView(AbstractHtmlContainer $parent = null)
    {

        $view = null;

        if ($this->baseViewClass !== null) {

            /** @var AbstractContentView $view */
            $view = new $this->baseViewClass($parent);
            $view->contentType = $this;

        } else {

            $view = new Paragraph($parent);
            $view->content = '[No Base View]';

        }

        return $view;

    }


}