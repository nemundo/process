<?php


namespace Nemundo\Process\Cms\Site;


use Nemundo\Web\Site\AbstractSite;

class CmsSite extends AbstractSite
{

    protected function loadSite()
    {

        $this->menuActive=false;
        $this->url='cms';

        new CmsSortableSite($this);
        new CmsEditorSite($this);

        // TODO: Implement loadSite() method.
    }


    public function loadContent()
    {
        // TODO: Implement loadContent() method.
    }

}