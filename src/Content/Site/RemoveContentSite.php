<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Dev\Deployment\StagingEnvironment;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Url\UrlReferer;

class RemoveContentSite extends AbstractSite
{

    /**
     * @var RemoveContentSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Remove Content';
        $this->url='remove-content';
        $this->menuActive=false;

        RemoveContentSite::$site=$this;

    }


    public function loadContent()
    {
        // TODO: Implement loadContent() method.

       // if (Envir StagingEnvironment::PRODUCTION)


        // nur in Dev/Test

    $contentType = (new ContentTypeParameter())->getContentType();

    $setup = new ContentTypeSetup();
    $setup->removeContent($contentType);

        (new UrlReferer())->redirect();

    }

}