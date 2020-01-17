<?php

namespace Nemundo\Process\Template\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Template\Content\File\FileDeleteContentType;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Web\Url\UrlReferer;


class FileDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var FileDeleteSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->url = 'delete-file';
        $this->menuActive = false;
        FileDeleteSite::$site = $this;
    }


    public function loadContent()
    {

        $status = new FileDeleteContentType();
        $status->parentId = (new ParentParameter())->getValue();
        $status->fileId = (new FileParameter())->getValue();
        $status->saveType();

        (new UrlReferer())->redirect();

    }

}