<?php


namespace Nemundo\Process\App\Wiki\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\App\Wiki\Group\WikiEditorGroup;
use Nemundo\Process\App\Wiki\Group\WikiGroupType;
use Nemundo\Process\Group\Com\Admin\GroupAdmin;
use Nemundo\Process\Group\Site\AbstractGroupRestrictionSite;

class AdminSite extends AbstractGroupRestrictionSite
{

    protected function loadSite()
    {
  $this->title = 'Administration';
  $this->url = 'admin';
        $this->groupRestriction=true;
        $this->addRestrictionGroup(new WikiEditorGroup());
    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $admin=new GroupAdmin($page);
        $admin->addGroupType(new WikiGroupType());


        $page->render();




    }

}