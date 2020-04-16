<?php

namespace Nemundo\Process\Template\Site\File;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Package\FontAwesome\Site\AbstractRestoreIconSite;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Template\Content\File\FileActiveContentType;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Content\File\FileInactiveContentType;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Web\Url\UrlReferer;


class FileActiveSite extends AbstractRestoreIconSite
{

    /**
     * @var FileActiveSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Restore File';
        $this->url = 'restore-file';
        $this->menuActive = false;
        FileActiveSite::$site = $this;
    }


    public function loadContent()
    {

        //$fileId = (new FileParameter())->getValue();
        //$fileContentType = new FileContentType($fileId);

        $contentParameter=new ContentParameter();
        $contentParameter->contentTypeCheck=false;


        $fileContentType = $contentParameter->getContentType();  // () new FileContentType($fileId);

        //(new Debug())->write( $fileContentType->getContentId());



        $status = new FileActiveContentType();
        $status->parentId = $fileContentType->getContentId();  // (new ParentParameter())->getValue();
        $status->fileId =$fileContentType->getDataId();  // $fileId;
        $status->saveType();

        (new UrlReferer())->redirect();

    }

}