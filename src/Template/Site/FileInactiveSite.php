<?php

namespace Nemundo\Process\Template\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Template\Content\File\FileInactiveContentType;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Web\Url\UrlReferer;


class FileInactiveSite extends AbstractDeleteIconSite
{

    /**
     * @var FileInactiveSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title='Delete (Soft Delete)';
        $this->url = 'inactive-file';
        $this->menuActive = false;
        FileInactiveSite::$site = $this;
    }


    public function loadContent()
    {

        $status = new FileInactiveContentType();
        $status->parentId = (new ParentParameter())->getValue();
        $status->fileId = (new FileParameter())->getValue();
        $status->saveType();

        (new UrlReferer())->redirect();

    }

}