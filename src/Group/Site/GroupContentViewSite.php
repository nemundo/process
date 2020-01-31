<?php


namespace Nemundo\Process\Group\Site;


use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Com\Html\Listing\UnorderedList;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Parameter\GroupParameter;
use Nemundo\Process\Group\Type\GroupContentType;
use Nemundo\Web\Site\AbstractSite;

class GroupContentViewSite extends AbstractSite
{
    /**
     * @var GroupContentViewSite
     */
    public static $site;

    protected function loadSite()
    {
   $this->url='group-content-view';
   GroupContentViewSite::$site=$this;
    }

    public function loadContent()
    {

        $page=(new DefaultTemplateFactory())->getDefaultTemplate();

        $groupId=(new GroupParameter())->getValue();

        /*
        $groupRow=(new GroupReader())->getRowById($groupId);

        $title=new AdminTitle($page);
        $title->content=$groupRow->group;*/


        $groupType = new GroupContentType($groupId);

        $groupType->getView($page);

        $title=new AdminTitle($page);
        $title->content=$groupType->getSubject();

        $ul = new UnorderedList($page);
        foreach ($groupType->getUserList() as $userCustomRow) {
            $ul->addText($userCustomRow->displayName);
        }



        $page->render();

        // TODO: Implement loadContent() method.
    }

}