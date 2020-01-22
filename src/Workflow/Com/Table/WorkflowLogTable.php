<?php


namespace Nemundo\Process\Workflow\Com\Table;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;


class WorkflowLogTable extends AbstractParentContainer
{


    public function getContent()
    {

        $table = new AdminClickableTable($this);

        $header = new TableHeader($table);
        $header->addText('Typ');

        $header->addText('History');
        $header->addText('Ersteller');

        foreach ($this->contentType->getChild() as $contentRow) {

            $status = $contentRow->getContentType();

            $row = new BootstrapClickableTableRow($table);
            $row->addText($status->typeLabel);
            $row->addText($status->getSubject());
            $row->addText($contentRow->user->displayName . ' ' . $contentRow->dateTime->getShortDateTimeLeadingZeroFormat());

            $row->addClickableSite($status->getViewSite());

        }

        return parent::getContent();

    }

}