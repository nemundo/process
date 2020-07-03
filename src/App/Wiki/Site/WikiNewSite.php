<?php


namespace Nemundo\Process\App\Wiki\Site;


use Nemundo\Process\App\Wiki\Group\WikiEditorGroup;
use Nemundo\Process\App\Wiki\Page\WikiNewPage;
use Nemundo\Process\Group\Site\AbstractGroupRestrictedSite;

class WikiNewSite extends AbstractGroupRestrictedSite
{

    protected function loadSite()
    {

        $this->title = 'New';
        $this->url = 'new';
        $this->groupRestricted = true;
        $this->addRestrictedGroup(new WikiEditorGroup());

    }


    public function loadContent()
    {

        (new WikiNewPage())->render();

    }

}