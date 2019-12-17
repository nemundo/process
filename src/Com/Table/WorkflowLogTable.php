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

//            $status = $logRow->status->getStatus();
            $status = $logRow->contentType->getContentType();

            if ($status->showLog) {
                $row = new TableRow($this);
                $row->addText($status->getSubject($logRow->dataId));
                $row->addText($logRow->userCreated->displayName . ' ' . $logRow->dateTimeCreated->getShortDateTimeLeadingZeroFormat());
            }

        }

        return parent::getContent();

    }

}