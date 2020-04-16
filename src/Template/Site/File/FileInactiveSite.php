<?php

namespace Nemundo\Process\Template\Site\File;


use Nemundo\Core\Debug\Debug;
use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Content\File\FileInactiveContentType;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Web\Url\UrlReferer;
use Schleuniger\Content\Dokument\DokumentProcessStatus;


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


        // content parameter

        //new DokumentProcessStatus()

        //$fileId =  (new FileParameter())->getValue();


        $contentParameter=new ContentParameter();
        $contentParameter->contentTypeCheck=false;


        $fileContentType = $contentParameter->getContentType();  // () new FileContentType($fileId);

        //(new Debug())->write( $fileContentType->getContentId());


        $type = new FileInactiveContentType();
        $type->parentId = $fileContentType->getContentId(); // (new ParentParameter())->getValue();
        $type->fileId =$fileContentType->getDataId();  // (new FileParameter())->getValue();
        $type->saveType();

        (new UrlReferer())->redirect();

    }

}