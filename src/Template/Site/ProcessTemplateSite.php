<?php


namespace Nemundo\Process\Template\Site;


use Nemundo\Process\Template\Data\TemplateFile\Redirect\TemplateFileFileRedirectSite;
use Nemundo\Web\Site\AbstractSite;

class ProcessTemplateSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->url = 'process-template';
        $this->menuActive = false;

        new TemplateFileFileRedirectSite($this);
        new FileInactiveSite($this);
        new SourceDeleteSite($this);

    }


    public function loadContent()
    {
        // TODO: Implement loadContent() method.
    }


}