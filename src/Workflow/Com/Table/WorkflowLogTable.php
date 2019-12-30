<?php


namespace Nemundo\Process\Workflow\Com\Table;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Workflow\Content\Item\Process\WorkflowItem;


class WorkflowLogTable extends AbstractParentContainer // AdminTable
{

    /**
     * @var string
     */
    //public $workflowId;


    public function getContent()
    {

        $table = new AdminTable($this);

        $header = new TableHeader($table);
//        $header->addText('Log');
        $header->addText('History');
        $header->addText('Ersteller');

        foreach ((new WorkflowItem($this->parentId))->getChild() as $contentRow) {

            $status = $contentRow->contentType->getContentType();

            if ($status->showLog) {
                $row = new TableRow($table);
                //$row->addText($status->getSubject($contentRow->id));
                $row->addText($contentRow->subject);

                $item = $status->getItem($contentRow->id);
                $row->addText($item->getSubject());


                $row->addText($contentRow->user->displayName . ' ' . $contentRow->dateTime->getShortDateTimeLeadingZeroFormat());
                // $row->addText($contentRow->dateTime->getShortDateTimeLeadingZeroFormat());

            }

        }

        return parent::getContent();

    }

}