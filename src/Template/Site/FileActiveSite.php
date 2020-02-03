<?php

namespace Nemundo\Process\Template\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Template\Content\File\FileActiveContentType;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Content\File\FileInactiveContentType;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Web\Url\UrlReferer;


class FileActiveSite extends AbstractDeleteIconSite
{

    /**
     * @var FileActiveSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title='Restore File';
        $this->url = 'restore-file';
        $this->menuActive = false;
        FileActiveSite::$site = $this;
    }


    public function loadContent()
    {

        $fileId =  (new FileParameter())->getValue();

        $fileContentType = new FileContentType($fileId);

        $status = new FileActiveContentType();
        $status->parentId =$fileContentType->getContentId();  // (new ParentParameter())->getValue();
        $status->fileId =$fileId;
        $status->saveType();

        (new UrlReferer())->redirect();

    }

}