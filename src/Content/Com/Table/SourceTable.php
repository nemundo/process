<?php


namespace Nemundo\Process\Content\Com\Table;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Debug\Debug;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Workflow\Content\Process\WorkflowProcess;


// müsste nach Content
// ParentTable
class SourceTable extends AbstractHtmlContainer  // AbstractParentContainer
{

    /**
     * @var AbstractTreeContentType
     */
    public $contentType;

    public function getContent()
    {

        //(new Debug())->write($this->parentId);

        //$workflowProcess = new WorkflowProcess($this->parentId);

        if ($this->contentType->getParentCount() > 0) {

            $table = new AdminClickableTable($this);

            $header = new TableHeader($table);
            $header->addText('Quelle');
            $header->addText('Type');

            foreach ($this->contentType->getParentContent() as $contentRow) {

                $row = new BootstrapClickableTableRow($table);

                $contentType = $contentRow->getContentType();
                $row->addText($contentType->getSubject());

                $row->addText($contentRow->contentType->contentType);

                $row->addClickableSite($contentType->getViewSite());

            }

        }

        return parent::getContent();

    }

}