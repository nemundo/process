<?php


namespace Nemundo\Process\Workflow\Com\Table;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Filter\Filter;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Collection\AbstractContentTypeCollection;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;


class WorkflowLogTable extends AbstractHtmlContainer
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


    public function getContent()
    {

        $table = new AdminClickableTable($this);

        $header = new TableHeader($table);
        $header->addText('Log');
        $header->addText('Ersteller');

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

        $reader->addOrder($reader->model->child->dateTime);
        $reader->addOrder($reader->model->itemOrder);

        foreach ($reader->getData() as $treeRow) {

            /** @var AbstractProcessStatus $contentType */
            $contentType = $treeRow->child->getContentType();

            $row = new BootstrapClickableTableRow($table);
            $row->addText($contentType->getMessage());
            $row->addText($treeRow->child->user->login . ' ' . $treeRow->child->dateTime->getShortDateTimeLeadingZeroFormat(), true);
            //$row->addText($treeRow->child->user->login . ' ' . $treeRow->child->dateTime->getShortDateTimeWithSecondLeadingZeroFormat(), true);
            $row->addClickableSite($contentType->getViewSite());

        }

        return parent::getContent();

    }

}