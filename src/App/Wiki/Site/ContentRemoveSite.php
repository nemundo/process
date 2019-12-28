<?php

namespace Nemundo\Process\App\Wiki\Site;

use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\Content\Item\TreeItem;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Web\Url\UrlReferer;

class ContentRemoveSite extends AbstractDeleteIconSite
{

    /**
     * @var ContentDeleteSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Remove Content';
        $this->url = 'content-remove';
        ContentRemoveSite::$site = $this;
    }

    public function loadContent()
    {

        $item = new TreeItem();
        $item->dataId = (new ContentParameter())->getValue();
        $item->parentId = (new WikiParameter())->getValue();
        $item->removeTree();

        (new UrlReferer())->redirect();

    }
}