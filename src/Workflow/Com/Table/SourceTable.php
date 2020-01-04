<?php


namespace Nemundo\Process\Workflow\Com\Table;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Workflow\Content\Process\WorkflowProcess;


// müsste nach Content

class SourceTable extends AbstractParentContainer
{

    public function getContent()
    {

        $table = new AdminClickableTable($this);

        $header = new TableHeader($table);
        $header->addText('Quelle');
        $header->addText('Type');

        foreach ((new WorkflowProcess($this->parentId))->getParentContent() as $contentRow) {

            $row = new BootstrapClickableTableRow($table);

            $contentType = $contentRow->getContentType();
            $row->addText($contentType->getSubject());

            $row->addText($contentRow->contentType->contentType);

            $row->addClickableSite($contentType->getViewSite());

        }

        return parent::getContent();

    }

}