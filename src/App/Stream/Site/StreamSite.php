<?php

namespace Nemundo\Process\App\Stream\Site;

use Nemundo\Admin\Com\Card\AdminCard;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Process\App\Stream\Data\Stream\StreamPaginationReader;
use Nemundo\Process\App\Stream\Data\Stream\StreamReader;
use Nemundo\Process\App\Stream\Event\StreamEvent;
use Nemundo\Process\App\Video\Content\YouTube\YouTubeContentType;
use Nemundo\Process\Cms\Com\Dropdown\CmsAddDropdown;
use Nemundo\Process\Cms\Event\CmsEvent;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Template\Content\Video\VideoContentType;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class StreamSite extends AbstractSite
{

    /**
     * @var StreamSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Stream';
        $this->url = 'stream';
        StreamSite::$site=$this;
    }

    public function loadContent()
    {

        $page=(new DefaultTemplateFactory())->getDefaultTemplate();






        $layout = new BootstrapTwoColumnLayout($page);



//        $form= (new YouTubeContentType())->getForm($layout->col2);


        $list=new CmsAddDropdown($layout->col2);


        $contentTypeParameter = new ContentTypeParameter();
        $contentTypeParameter->contentTypeCheck = false;
        if ($contentTypeParameter->exists()) {

            $contentType = $contentTypeParameter->getContentType();
            //$contentType->parentId = $parentId;
            $contentType->addEvent(new StreamEvent());

            $form = $contentType->getForm($layout->col2);
            $form->appendParameter = false;
            $form->redirectSite = new Site();
            $form->redirectSite->removeParameter(new ContentTypeParameter());

        }







        $streamReader=new StreamPaginationReader();
        $streamReader->model->loadContent();
        $streamReader->model->content->loadContentType();
        $streamReader->addOrder($streamReader->model->id, SortOrder::DESCENDING);
        $streamReader->paginationLimit= ProcessConfig::PAGINATION_LIMIT;

        foreach ($streamReader->getData() as $streamRow) {


            $contentType= $streamRow->content->getContentType();


            $card=new AdminCard($layout->col1);
            $card->title = $contentType->getSubject().' '.$contentType->dateTime->getShortDateTimeLeadingZeroFormat();

            //$subtitle=new AdminSubtitle($layout->col1);
            //$subtitle->content=$contentType->dateTime->getShortDateTimeLeadingZeroFormat();

            $contentType->getView($card);

        }


        $pagination=new BootstrapPagination($layout->col1);
        $pagination->paginationReader=$streamReader;



        $page->render();


    }
}