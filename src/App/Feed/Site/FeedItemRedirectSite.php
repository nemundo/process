<?php


namespace Nemundo\Process\App\Feed\Site;


use Nemundo\Process\App\Feed\Content\Item\FeedItemContentType;
use Nemundo\Process\App\Feed\Parameter\FeedItemParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Url\UrlRedirect;

class FeedItemRedirectSite extends AbstractSite
{

    /**
     * @var FeedItemRedirectSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->url='feed-redirect';
        $this->menuActive=false;
        // TODO: Implement loadSite() method.

        FeedItemRedirectSite::$site=$this;

    }


    public function loadContent()
    {

        $feedItemId=(new FeedItemParameter())->getValue();

        $feedItemRow = (new FeedItemContentType($feedItemId))->getDataRow();
        (new UrlRedirect())->redirect($feedItemRow->url);



    }

}