<?php


namespace Nemundo\Process\Content\Com\Table;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTableHeader;
use Nemundo\Core\Debug\Debug;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Content\Type\AbstractTreeContentType;




// ParentSourceTable
class SourceTable extends AbstractHtmlContainer
{

    /**
     * @var AbstractTreeContentType
     */
    public $contentType;

    public function getContent()
    {

        if ($this->contentType->getParentCount() > 0) {

            $table = new AdminClickableTable($this);

            $header = new AdminTableHeader($table);
            $header->addText('Quelle');
            $header->addText('Typ');

            foreach ($this->contentType->getParentContent() as $contentRow) {

                $row = new BootstrapClickableTableRow($table);
                $contentType = $contentRow->getContentType();
                if ($contentType->hasViewSite()) {
                $row->addSite($contentType->getSubjectViewSite());
                }
                //$row->addText($contentType->getSubject());

                $row->addText($contentRow->contentType->contentType);

                $row->addClickableSite($contentType->getViewSite());

            }

        }

        return parent::getContent();

    }

}