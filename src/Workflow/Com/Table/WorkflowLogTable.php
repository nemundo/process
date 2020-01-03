<?php


namespace Nemundo\Process\Workflow\Com\Table;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Workflow\Content\Item\Process\WorkflowItem;
use Nemundo\Process\Workflow\Content\Process\WorkflowProcess;


class WorkflowLogTable extends AbstractParentContainer
{


    public function getContent()
    {

        $table = new AdminTable($this);

        $header = new TableHeader($table);
//        $header->addText('Log');
        $header->addText('History');
        $header->addText('Ersteller');

        foreach ((new WorkflowProcess($this->parentId))->getChild() as $contentRow) {

            $status = $contentRow->getContentType();

            if ($status->showLog) {
                $row = new TableRow($table);
                //$row->addText($status->getSubject($contentRow->id));
                $row->addText($contentRow->subject);

                //$item = $status->getItem($contentRow->id);
                $row->addText($status->getSubject());


                $row->addText($contentRow->user->displayName . ' ' . $contentRow->dateTime->getShortDateTimeLeadingZeroFormat());
                // $row->addText($contentRow->dateTime->getShortDateTimeLeadingZeroFormat());

            }

        }

        return parent::getContent();

    }

}