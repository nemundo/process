<?php

namespace Nemundo\Process\Template\Site\File;


use Nemundo\Core\Debug\Debug;
use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Parameter\ContentParameter;
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
        $this->title ='Datei löschen';  // 'Delete (Soft Delete)';
        $this->url = 'inactive-file';
        $this->menuActive = false;
        FileInactiveSite::$site = $this;
    }


    public function loadContent()
    {

        /*
        $contentParameter = new ContentParameter();
        $contentParameter->contentTypeCheck = false;

        $fileContentType = $contentParameter->getContentType();*/


        $fileContentType = (new FileParameter())->getContentType();

        $type = new FileInactiveContentType();
        $type->parentId = $fileContentType->getContentId();
        $type->fileId = $fileContentType->getDataId();
        $type->saveType();

        (new UrlReferer())->redirect();

    }

}