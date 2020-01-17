<?php


namespace Nemundo\Process\Group\Site;


use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Parameter\GroupParameter;
use Nemundo\Web\Site\AbstractSite;

class GroupItemSite extends AbstractSite
{
    /**
     * @var GroupItemSite
     */
    public static $site;

    protected function loadSite()
    {
   $this->url='group-item';
   GroupItemSite::$site=$this;
    }

    public function loadContent()
    {

        $page=(new DefaultTemplateFactory())->getDefaultTemplate();

        $groupId=(new GroupParameter())->getValue();

        $groupRow=(new GroupReader())->getRowById($groupId);

        $title=new AdminTitle($page);
        $title->content=$groupRow->group;


        $page->render();

        // TODO: Implement loadContent() method.
    }

}