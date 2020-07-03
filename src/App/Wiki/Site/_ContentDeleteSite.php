<?php

namespace Nemundo\Process\App\Wiki\Site;

use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Parameter\ContentParameter;
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
        ContentDeleteSite::$site = $this;
    }

    public function loadContent()
    {

        $type = (new ContentParameter())->getContentType();
        $type->deleteType();

/*
        $contentId = (new ContentParameter())->getValue();

        $contentReader = new ContentReader();
        $contentReader->model->loadContentType();
        $contentRow = $contentReader->getRowById($contentId);
        $type = $contentRow->getContentType();
        $type->deleteType();*/


        (new UrlReferer())->redirect();

    }
}