<?php


namespace Nemundo\Process\App\Feed\Site;


use Nemundo\Admin\Com\Button\AdminSearchButton;
use Nemundo\Admin\Com\Button\AdminSubmitButton;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Form\Input\TextInput;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Feed\Content\Feed\FeedContentForm;
use Nemundo\Process\App\Feed\Content\Feed\FeedContentType;
use Nemundo\Process\App\Feed\Content\Item\FeedItemContentType;
use Nemundo\Process\App\Feed\Data\Feed\FeedReader;
use Nemundo\Process\App\Feed\Data\FeedItem\FeedItemPaginationReader;
use Nemundo\Process\App\Feed\Data\FeedItem\FeedItemReader;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Rss\RssReader;
use Nemundo\Web\Site\AbstractSite;

class FeedCrawlerSite extends AbstractSite
{

    protected function loadSite()
    {

        $this->title='Feed Crawler';
        $this->url='feed-crawler';

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $form=new SearchForm($page);

        $formRow=new BootstrapFormRow($form);

        $feedInput=new BootstrapTextBox($formRow);
        $feedInput->label='Feed Url';
        //$feedInput->value='https://www.srf.ch/feed/podcast/sd/66d56e22-51cf-47a6-badd-7776ec4f6501.xml';

        $submit=new AdminSearchButton($formRow);  // AdminSubmitButton($formRow);



        if ($feedInput->hasValue()) {



            $table=new AdminTable($page);

            $rssReader=new RssReader();
            $rssReader->feedUrl=$feedInput->getValue();
            foreach ($rssReader->getData() as $rssItem) {

                $row=new TableRow($table);
                $row->addText($rssItem->title);
                $row->addText($rssItem->description);

                $input=new TextInput($row);
                $input->value=$rssItem->enclosureUrl;

            }







        }



        $page->render();



    }

}