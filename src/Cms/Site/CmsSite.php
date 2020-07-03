<?php


namespace Nemundo\Process\Cms\Site;


use Nemundo\Process\Cms\Page\CmsPage;
use Nemundo\Web\Site\AbstractSite;

class CmsSite extends AbstractSite
{

    protected function loadSite()
    {

        $this->title='Cms';
        $this->url = 'cms';

        new CmsSortableSite($this);
        new CmsEditorSite($this);
        new CmsDeleteSite($this);

    }


    public function loadContent()
    {
        (new CmsPage())->render();
    }

}