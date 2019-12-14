<?php


namespace Nemundo\Process\Com\Table;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Item\WorkflowItem;


class WorkflowLogTable extends AdminTable
{

    /**
     * @var string
     */
    public $workflowId;


    public function getContent()
    {

        $header = new TableHeader($this);
//        $header->addText('Log');
        $header->addText('History');
        $header->addText('Ersteller');

        foreach ((new WorkflowItem($this->workflowId))->getWorkflowLog() as $logRow) {

            $status = $logRow->status->getStatus();

            if ($status->showLog) {
                $row = new TableRow($this);
                $row->addText($status->getLogText($logRow->dataId));
                $row->addText($logRow->user->displayName . ' ' . $logRow->dateTime->getShortDateTimeLeadingZeroFormat());
            }

        }

        return parent::getContent();

    }

}