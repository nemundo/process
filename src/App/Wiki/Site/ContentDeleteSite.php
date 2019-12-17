<?php

namespace Nemundo\Process\App\Wiki\Site;

use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Parameter\ContentParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Url\UrlReferer;

class ContentDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var ContentDeleteSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'ContentDelete';
        $this->url = 'contentdelete';
        ContentDeleteSite::$site=$this;
    }

    public function loadContent()
    {

        $contentId = (new ContentParameter())->getValue();
        (new ContentDelete())->deleteById($contentId);
        (new UrlReferer())->redirect();

    }
}