<?php


namespace Nemundo\Process\App\Wiki\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\App\Wiki\Com\WikiNavigation;
use Nemundo\Process\App\Wiki\Content\WikiPageContentForm;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Group\WikiEditorGroup;
use Nemundo\Process\Group\Site\AbstractGroupRestrictionSite;
use Nemundo\Web\Site\AbstractSite;

class WikiNewSite extends AbstractGroupRestrictionSite
{

    protected function loadSite()
    {
        $this->title = 'New';
        $this->url = 'new';
        $this->groupRestriction=true;
        $this->addRestrictionGroup(new WikiEditorGroup());
    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        new WikiNavigation($page);


        $form = (new WikiPageContentType())->getForm($page);
        $form->appendParameter = true;
        $form->redirectSite = WikiSite::$site;


        $page->render();

    }

}