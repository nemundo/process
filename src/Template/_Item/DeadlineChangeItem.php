<?php


namespace Nemundo\Process\Template\Item;


use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Process\Template\Data\DeadlineChange\DeadlineChange;
use Nemundo\Process\Template\Data\DeadlineChange\DeadlineChangeReader;
use Nemundo\Process\Template\Status\DeadlineChangeProcessStatus;
use Nemundo\Process\Workflow\Content\Item\Process\WorkflowItem;
use Nemundo\Process\Workflow\Content\Item\Status\AbstractStatusItem;

class DeadlineChangeItem extends AbstractStatusItem
{

    /**
     * @var Date
     */
    public $deadline;


    protected function saveData()
    {


        $this->contentType = new DeadlineChangeProcessStatus();

        $deadlineHasChanged = true;

        $processItem = new WorkflowItem($this->parentId);
        if ($processItem->hasDeadline()) {
            if ($this->deadline->getIsoDateFormat() == $processItem->getDeadline()->getIsoDateFormat()) {
                $deadlineHasChanged = false;
            }
        }

        if ($deadlineHasChanged) {

            $data = new DeadlineChange();
            $data->id = $this->dataId;
            $data->deadline = $this->deadline;
            $data->save();

            $item = new WorkflowItem($this->parentId);
            $item->changeDeadline($this->deadline);

            //$this->saveWorkflowLog();

        }


    }



    public function getSubject()
    {

        $deadlineRow = (new DeadlineChangeReader())->getRowById($this->dataId);
        $subject = 'Neues Datum für Fertigstellung: ' . $deadlineRow->deadline->getShortDateLeadingZeroFormat();

        return $subject;

    }

}