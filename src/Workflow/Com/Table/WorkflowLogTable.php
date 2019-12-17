<?php


namespace Nemundo\Process\Workflow\Com\Table;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Workflow\Content\Item\Process\ProcessItem;
use Nemundo\Process\Workflow\Content\Item\WorkflowItem;


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

        foreach ((new ProcessItem($this->workflowId))->getChildContent() as $contentRow) {

            $status = $contentRow->contentType->getContentType();

            if ($status->showLog) {
                $row = new TableRow($this);
                $row->addText($status->getSubject($contentRow->dataId));
                $row->addText($contentRow->userCreated->displayName . ' ' . $contentRow->dateTimeCreated->getShortDateTimeLeadingZeroFormat());
            }

        }

        return parent::getContent();

    }

}