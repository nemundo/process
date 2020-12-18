<?php


namespace Nemundo\Process\Cms\Site;


use Nemundo\Process\Cms\Page\CmsEditorPage;
use Nemundo\Web\Site\AbstractSite;

class CmsEditorSite extends AbstractSite
{

    /**
     * @var CmsEditorSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Cms Editor';
        $this->url = 'cms-editor';
        $this->menuActive = false;
        CmsEditorSite::$site = $this;
    }


    public function loadContent()
    {
        (new CmsEditorPage())->render();
    }

}