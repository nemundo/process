<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Url\UrlReferer;

class ContentIndexSite extends AbstractSite
{

    /**
     * @var ContentIndexSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Content Index';
        $this->url = 'content-index';
        $this->menuActive = false;

        ContentIndexSite::$site = $this;

    }


    public function loadContent()
    {

        $contentParameter = new ContentParameter();
        $contentParameter->contentTypeCheck = false;
        $contentType = $contentParameter->getContentType();
        $contentType->saveIndex();

        (new UrlReferer())->redirect();

    }

}