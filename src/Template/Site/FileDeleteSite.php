<?php

namespace Nemundo\Process\Template\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Template\Content\File\FileContentType;
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
        $this->title = 'Delete';
        $this->url = 'delete-file';
        $this->menuActive = false;
        FileDeleteSite::$site = $this;
    }


    public function loadContent()
    {

        $fileId = (new FileParameter())->getValue();
        (new FileContentType($fileId))->deleteType();

        (new UrlReferer())->redirect();

    }

}