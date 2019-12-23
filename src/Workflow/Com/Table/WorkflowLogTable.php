<?php


namespace Nemundo\Process\Workflow\Com\Table;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Workflow\Content\Item\Process\WorkflowItem;


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

        foreach ((new WorkflowItem($this->workflowId))->getChild() as $contentRow) {

            $status = $contentRow->contentType->getContentType();

            if ($status->showLog) {
                $row = new TableRow($this);
                $row->addText($status->getSubject($contentRow->id));
                $row->addText($contentRow->user->displayName . ' ' . $contentRow->dateTime->getShortDateTimeLeadingZeroFormat());
                // $row->addText($contentRow->dateTime->getShortDateTimeLeadingZeroFormat());

            }

        }

        return parent::getContent();

    }

}