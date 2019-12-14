<?php


namespace Nemundo\Process\Template\Site;


use Nemundo\Process\Template\Data\Document\Redirect\DocumentDocumentRedirectSite;
use Nemundo\Web\Site\AbstractSite;

class ProcessTemplateSite extends AbstractSite
{

    protected function loadSite()
    {
   $this->url = 'process-template';
   $this->menuActive=false;

        new DocumentDocumentRedirectSite($this);
        new DocumentDeleteSite($this);

    }


    public function loadContent()
    {
        // TODO: Implement loadContent() method.
    }


}