<?php


namespace Nemundo\Process\App\Feed\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Feed\Content\Feed\FeedContentType;
use Nemundo\Process\App\Feed\Content\Item\FeedItemContentType;
use Nemundo\Process\App\Feed\Data\Feed\FeedReader;
use Nemundo\Process\App\Feed\Data\FeedItem\FeedItemPaginationReader;
use Nemundo\Process\App\Feed\Parameter\FeedParameter;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Web\Site\AbstractSite;

class FeedSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Feed';
        $this->url = 'feed';

        new FeedItemRedirectSite($this);
        new FeedDeleteSite($this);

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $layout = new BootstrapTwoColumnLayout($page);
        $layout->col1->columnWidth = 4;
        $layout->col2->columnWidth = 4;


        $table = new AdminClickableTable($layout->col1);

        $feedReader = new FeedReader();
        foreach ($feedReader->getData() as $feedRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addText($feedRow->feedUrl);
            $row->addText($feedRow->title);

            $site = clone(FeedDeleteSite::$site);
            $site->addParameter(new FeedParameter($feedRow->id));
            $row->addIconSite($site);

        }

        (new FeedContentType())->getForm($layout->col1);

        //new FeedContentForm($layout->col1);
        // search


        $table = new AdminClickableTable($layout->col2);

        $itemReader = new FeedItemPaginationReader();
        $itemReader->model->loadFeed();
        $itemReader->addOrder($itemReader->model->dateTime,SortOrder::DESCENDING);
        $itemReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;
        foreach ($itemReader->getData() as $itemRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addText($itemRow->title);
            $row->addText($itemRow->description);
            $row->addText($itemRow->dateTime->getShortDateTimeLeadingZeroFormat());
            $row->addText($itemRow->feed->title);

            $contentType = new FeedItemContentType($itemRow->id);
            $row->addClickableSite($contentType->getViewSite());

        }

        $pagination = new BootstrapPagination($layout->col2);
        $pagination->paginationReader = $itemReader;

        $page->render();

    }

}