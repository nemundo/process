<?php

namespace Nemundo\Process\Template\Site\Image;


use Nemundo\Core\Debug\Debug;
use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Template\Content\File\FileInactiveContentType;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Process\Template\Parameter\ImageParameter;
use Nemundo\Core\Http\Url\UrlReferer;


class ImageInactiveSite extends AbstractDeleteIconSite
{

    /**
     * @var ImageInactiveSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title='Inaktiv setzen';
        $this->url = 'inactive-image';
        $this->menuActive = false;
      ImageInactiveSite::$site = $this;
    }


    public function loadContent()
    {

        //$imageId = (new ImageParameter())->getValue();

        $type =  (new ImageParameter())->getContentType();
        $type->setInactive();


        /*
        $status = new FileInactiveContentType();
        $status->parentId = (new ParentParameter())->getValue();
        $status->fileId = (new FileParameter())->getValue();
        $status->saveType();*/

        (new UrlReferer())->redirect();

    }

}