<?php


namespace Nemundo\Process\Workflow\Content\Status;

use Nemundo\Core\Language\Translation;
use Nemundo\Process\App\Notification\Type\NotificationTrait;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Group\Check\GroupRestrictedTrait;
use Nemundo\Process\Workflow\Content\Form\StatusForm;


abstract class AbstractProcessStatus extends AbstractSequenceContentType
{

    use ProcessStatusTrait;
    use GroupRestrictedTrait;
    use NotificationTrait;

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


    protected function onIndex()
    {

        parent::onIndex();
        $this->saveNotificationIndex();

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
    //protected function getMessage()
    {

        $message = (new Translation())->getText($this->typeLabel);
        return $message;

    }

}