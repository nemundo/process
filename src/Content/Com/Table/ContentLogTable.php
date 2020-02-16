<?php


namespace Nemundo\Process\Content\Com\Table;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Filter\Filter;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Collection\AbstractContentTypeCollection;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Row\ContentCustomRow;
use Nemundo\Process\Content\Type\AbstractTreeContentType;


class ContentLogTable extends AbstractHtmlContainer
{

    /**
     * @var AbstractTreeContentType
     */
    public $contentType;


    /**
     * @var AbstractContentTypeCollection[]
     */
    private $collectionFilterList = [];

    public function addCollectionFilter(AbstractContentTypeCollection $collection)
    {
        $this->collectionFilterList[] = $collection;
        return $this;
    }


    public function addContentTypeFilter(AbstractTreeContentType $contentType)
    {


    }


    public function getContent()
    {

        $table = new AdminClickableTable($this);

        $header = new TableHeader($table);
        //$header->addText('Typ');

        $header->addText('History');
        $header->addText('Ersteller');
        //$header->addText('Data Id');


        $reader = new TreeReader();
        $reader->model->loadChild();
        $reader->model->child->loadContentType();
        $reader->model->child->loadUser();

        $reader->filter->andEqual($reader->model->parentId, $this->contentType->getContentId());


        $filter = new Filter();
        foreach ($this->collectionFilterList as $collection) {

            foreach ($collection->getContentTypeList() as $contentType) {
                $filter->orEqual($reader->model->child->contentTypeId, $contentType->typeId);
            }

        }

        if ($filter->isNotEmpty()) {
            $reader->filter->andFilter($filter);
        }

        $reader->addOrder($reader->model->itemOrder);

        foreach ($reader->getData() as $treeRow) {



        //foreach ($this->contentType->getChild() as $contentRow) {

            $contentType = $treeRow->child->getContentType();

            $row = new BootstrapClickableTableRow($table);
            $row->addText($contentType->typeLabel);
            $row->addText($contentType->getSubject());
            //$row->addText($contentType->getText());

            //$contentType->getView($row);

            //$row->addText($contentRow->user->displayName . ' ' . $contentRow->dateTime->getShortDateTimeLeadingZeroFormat());
            $row->addText($treeRow->child->user->displayName . ' ' .$treeRow->child->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());

            //$row->addText($contentRow->dataId);

            $row->addClickableSite($contentType->getViewSite());

        }

        return parent::getContent();

    }

}