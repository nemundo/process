<?php

namespace Nemundo\Process\Template\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Content\File\FileInactiveContentType;
use Nemundo\Process\Template\Data\TemplateMultiFile\TemplateMultiFileUpdate;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Core\Http\Url\UrlReferer;


class MultiFileDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var MultiFileDeleteSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title='Delete';
        $this->url = 'delete-multi-file';
        $this->menuActive = false;
       MultiFileDeleteSite::$site = $this;
    }


    public function loadContent()
    {

        $fileId =  (new FileParameter())->getValue();

        $update = new TemplateMultiFileUpdate();
        $update->active = false;
        $update->updateById($fileId);

        (new UrlReferer())->redirect();

    }

}