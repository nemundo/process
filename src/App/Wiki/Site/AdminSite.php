<?php


namespace Nemundo\Process\App\Wiki\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\App\Wiki\Group\Type\WikiGroupType;
use Nemundo\Process\App\Wiki\Group\WikiEditorGroup;
use Nemundo\Process\Group\Com\Admin\GroupAdmin;
use Nemundo\Process\Group\Site\AbstractGroupRestrictedSite;

class AdminSite extends AbstractGroupRestrictedSite
{

    protected function loadSite()
    {
        $this->title = 'Administration';
        $this->url = 'admin';
        $this->groupRestricted = true;
        $this->addRestrictedGroup(new WikiEditorGroup());
    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $admin = new GroupAdmin($page);
        $admin->addGroupType(new WikiGroupType());


        $page->render();


    }

}