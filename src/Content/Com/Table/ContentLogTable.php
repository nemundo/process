<?php


namespace Nemundo\Process\Content\Com\Table;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Com\Container\AbstractParentContainer;
use Nemundo\Process\Content\Type\AbstractTreeContentType;


class ContentLogTable extends AbstractHtmlContainer
{

    /**
     * @var AbstractTreeContentType
     */
    public $contentType;

    public function getContent()
    {

        $table = new AdminClickableTable($this);

        $header = new TableHeader($table);
        //$header->addText('Typ');

        $header->addText('History');
        $header->addText('Ersteller');
        //$header->addText('Data Id');

        foreach ($this->contentType->getChild() as $contentRow) {

            $contentType = $contentRow->getContentType();

            $row = new BootstrapClickableTableRow($table);
            $row->addText($contentType->typeLabel);
            $row->addText($contentType->getSubject());
            //$row->addText($contentRow->user->displayName . ' ' . $contentRow->dateTime->getShortDateTimeLeadingZeroFormat());
            $row->addText($contentRow->user->displayName . ' ' . $contentRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());

            //$row->addText($contentRow->dataId);

            $row->addClickableSite($contentType->getViewSite());

        }

        return parent::getContent();

    }

}