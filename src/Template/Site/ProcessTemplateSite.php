<?php


namespace Nemundo\Process\Template\Site;


use Nemundo\Process\Template\Data\TemplateFile\Redirect\TemplateFileFileRedirectSite;
use Nemundo\Process\Template\Data\TemplateMultiFile\Redirect\TemplateMultiFileFileRedirectSite;
use Nemundo\Process\Template\Site\File\FileActiveSite;
use Nemundo\Process\Template\Site\File\FileInactiveSite;
use Nemundo\Process\Template\Site\Image\ImageActiveSite;
use Nemundo\Process\Template\Site\Image\ImageInactiveSite;
use Nemundo\Web\Site\AbstractSite;

class ProcessTemplateSite extends AbstractSite
{

    protected function loadSite()
    {

        $this->url = 'process-template';
        $this->menuActive = false;

        new TemplateFileFileRedirectSite($this);
        new TemplateMultiFileFileRedirectSite($this);

        new FileActiveSite($this);
        new FileInactiveSite($this);

        new ImageActiveSite($this);
        new ImageInactiveSite($this);

        new SourceDeleteSite($this);
        new ChildRemoveSite($this);
        new MultiFileDeleteSite($this);

    }


    public function loadContent()
    {

    }


}