<?php


namespace Nemundo\Process\Cms\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Cms\Data\Cms\CmsDelete;
use Nemundo\Process\Cms\Page\CmsEditorPage;
use Nemundo\Process\Cms\Parameter\CmsParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Url\UrlReferer;

class CmsDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var CmsDeleteSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->url = 'cms-delete';
        $this->menuActive = false;
        CmsDeleteSite::$site = $this;
    }


    public function loadContent()
    {

        $cmsId=(new CmsParameter())->getValue();
        (new CmsDelete())->deleteById($cmsId);
        (new UrlReferer())->redirect();

    }

}