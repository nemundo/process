<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Data\Tree\TreePaginationReader;
use Nemundo\Web\Site\AbstractSite;

class TreeSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Tree';
        $this->url = 'tree';

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('Parent');
        $header->addText('Parent Id');
        $header->addText('Child');
        $header->addText('Child Id');

/*
        $header->addText('Subject (Db Content)');
        $header->addText('Subject (Item)');
        $header->addText('Date/Time');
        $header->addText('User');
        $header->addEmpty();*/


        $treeReader = new TreePaginationReader();
        $treeReader->model->loadParent();
        $treeReader->model->parent->loadContentType();
        $treeReader->model->loadChild();
        $treeReader->model->child->loadContentType();
        $treeReader->addOrder($treeReader->model->id, SortOrder::DESCENDING);
        $treeReader->paginationLimit = 50;


        foreach ($treeReader->getData() as $treeRow) {

            $row = new BootstrapClickableTableRow($table);

            $row->addText($treeRow->parent->contentType->contentType);
            $row->addText($treeRow->parentId);


            $row->addText($treeRow->child->contentType->contentType);
            $row->addText($treeRow->childId);

        }


        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $treeReader;


        $page->render();


    }


}