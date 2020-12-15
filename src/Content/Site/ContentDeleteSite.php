<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Core\Http\Url\UrlReferer;

class ContentDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var ContentDeleteSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->url = 'content-delete';
        ContentDeleteSite::$site = $this;
    }

    public function loadContent()
    {

        $contentParameter = new ContentParameter();
        $contentParameter->contentTypeCheck = false;
        $contentType = $contentParameter->getContentType();
        $contentType->deleteType();

        (new UrlReferer())->redirect();

    }

}