<?php


namespace Nemundo\Process\Template\Site;


use Nemundo\Process\Template\Data\TemplateFile\Redirect\TemplateFileFileRedirectSite;
use Nemundo\Process\Template\Data\TemplateMultiFile\Redirect\TemplateMultiFileFileRedirectSite;
use Nemundo\Web\Site\AbstractSite;

class ProcessTemplateSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->url = 'process-template';
        $this->menuActive = false;

        new TemplateFileFileRedirectSite($this);
        new TemplateMultiFileFileRedirectSite($this);
        new FileInactiveSite($this);
        new SourceDeleteSite($this);
        new ChildRemoveSite($this);
        new MultiFileDeleteSite($this);


    }


    public function loadContent()
    {
        // TODO: Implement loadContent() method.
    }


}