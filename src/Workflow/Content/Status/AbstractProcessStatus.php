<?php


namespace Nemundo\Process\Workflow\Content\Status;

use Nemundo\Process\App\Notification\Type\NotificationTrait;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Content\Writer\TreeWriter;
use Nemundo\Process\Group\Check\GroupRestrictedTrait;
use Nemundo\Process\Log\Type\LogTrait;
use Nemundo\Process\Workflow\Content\Form\StatusForm;


// AbstractWorkflowStatus
abstract class AbstractProcessStatus extends AbstractSequenceContentType
{

    use ProcessStatusTrait;
    //use LogTrait;
    use GroupRestrictedTrait;
    use NotificationTrait;

    /**
     * @var bool
     */
    //public $toggleView = false;



    public function __construct($dataId = null)
    {
        $this->formClass = StatusForm::class;
        parent::__construct($dataId);
    }


    protected function onFinished()
    {

        parent::onFinished();
        $this->sendFavoriteNotification($this->getParentProcess());

    }


    public function saveType()
    {

        $this->saveData();
        $this->saveContent();
        $this->saveTree();

        $parentProcess = $this->getParentProcess();

        if ($this->changeStatus) {
            $parentProcess->changeStatus($this);
        }

        if ($this->closeWorkflow) {
            $parentProcess->closeWorkflow();
        }

        $this->onFinished();
        $this->saveIndex();
        $this->getParentProcess()->saveIndex();

    }


    public function saveIndex()
    {

        $this->onDataRow();
        $this->saveContentIndex();
        $this->onIndex();

    }




    public function getSubject()
    {
        return $this->getParentContentType()->getSubject();
    }


    public function hasViewSite()
    {
        return true;
    }


    public function getViewSite()
    {

        return $this->getParentContentType()->getViewSite();

    }




    public function getMessage()
    {
        return $this->getSubject();
        // TODO: Implement getMessage() method.
    }





}