<?php


namespace Nemundo\Process\Workflow\Com\Table;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Workflow\Content\Item\Process\WorkflowItem;
use Nemundo\Process\Workflow\Content\Process\WorkflowProcess;


// müsste nach Content

class SourceTable extends AbstractParentContainer
{

    public function getContent()
    {

        $table=new AdminTable($this);

        $header = new TableHeader($table);
        $header->addText('Quelle');

        foreach ((new WorkflowProcess($this->parentId))->getParentContent() as $contentRow) {
            $row = new TableRow($this);
            $contentType = $contentRow->contentType->getContentType();
            $row->addText($contentType->getClassName());
        }

        return parent::getContent();

    }

}