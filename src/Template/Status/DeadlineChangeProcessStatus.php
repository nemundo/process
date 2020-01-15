<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Process\Template\Data\DeadlineChange\DeadlineChange;
use Nemundo\Process\Template\Data\DeadlineChange\DeadlineChangeReader;
use Nemundo\Process\Template\Form\DeadlineChangeForm;
use Nemundo\Process\Workflow\Content\Item\Process\WorkflowItem;
use Nemundo\Process\Workflow\Content\Process\WorkflowProcess;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class DeadlineChangeProcessStatus extends AbstractProcessStatus
{


    /**
     * @var Date
     */
    public $deadline;


    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Deadline Change';
        $this->typeLabel[LanguageCode::DE] = 'Termverschiebung';
        $this->typeId = 'cd3ade01-3ef1-452f-8a45-dce792547220';
        $this->changeStatus = false;

        $this->formClass = DeadlineChangeForm::class;

    }


    public function onCreate()
    {

        $processItem = $this->getParentProcess();

        /*
        $deadlineHasChanged = true;

        $processItem = $this->getParentProcess();  // new WorkflowProcess($this->parentId);
        if ($processItem->hasDeadline()) {
            if ($this->deadline->getIsoDateFormat() == $processItem->getDeadline()->getIsoDateFormat()) {
                $deadlineHasChanged = false;
            }
        }

        if ($deadlineHasChanged) {*/

            $data = new DeadlineChange();
            //$data->id = $this->dataId;
            $data->deadline = $this->deadline;
            $this->dataId= $data->save();

            //$item = new WorkflowItem($this->parentId);
            $processItem->changeDeadline($this->deadline);

            //$this->saveWorkflowLog();

            // nur hier content eintrag erstellen!!!

        //}
    }


    public function getSubject()
    {

        $deadlineRow = (new DeadlineChangeReader())->getRowById($this->dataId);
        $subject = 'Neues Datum für Fertigstellung: ' . $deadlineRow->deadline->getShortDateLeadingZeroFormat();

        return $subject;

    }

}