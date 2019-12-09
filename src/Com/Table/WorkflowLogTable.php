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
        $header->addText('Log');
        $header->addText('Ersteller');

        foreach ((new WorkflowItem($this->workflowId))->getWorkflowLog() as $logRow) {


            $row = new TableRow($this);

            $status = $logRow->status->getStatus();
            $row->addText($status->getLogText($logRow->dataId));
            $row->addText($logRow->user->displayName . ' ' . $logRow->dateTime->getShortDateLeadingZeroFormat());

        }

        return parent::getContent();

    }

}