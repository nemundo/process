<?php


namespace Nemundo\Process\Search\Site;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Model\Join\ModelJoin;
use Nemundo\Process\Content\Data\Content\ContentModel;
use Nemundo\Process\Search\Data\SearchLog\SearchLogPaginationReader;
use Nemundo\Process\Search\Data\SearchLog\SearchLogReader;
use Nemundo\Web\Site\AbstractSite;

class SearchLogSite extends AbstractSite
{

    protected function loadSite()
    {
   $this->title='Search Log';
   $this->url='search-log';
    }

    public function loadContent()
    {

        $page=(new DefaultTemplateFactory())->getDefaultTemplate();


        $table=new AdminTable($page);

        $header=new TableHeader($table);
        $header->addText('Search Query');
        $header->addText('Result Count');
        $header->addText('User');
        $header->addText('Date/Time');

        $reader = new SearchLogPaginationReader();

        $contentModel = new ContentModel();
        $contentModel->loadUser();

        $join = new ModelJoin($reader);
        $join->externalModel=$contentModel;
        $join->externalType=$contentModel->dataId;
        $join->type = $reader->model->id;

        $reader->addFieldByModel($contentModel);
        $reader->checkExternal($contentModel);


        $reader->addOrder($reader->model->id, SortOrder::DESCENDING);
        $reader->paginationLimit=100;
        foreach ($reader->getData() as $searchLogRow) {

            $row=new TableRow($table);
            $row->addText($searchLogRow->searchQuery);
            $row->addText($searchLogRow->resultCount);

            $row->addText($searchLogRow->getModelValue($contentModel->user->login));
            $row->addText($searchLogRow->getModelValue($contentModel->dateTime));


        }




        $page->render();


    }

}