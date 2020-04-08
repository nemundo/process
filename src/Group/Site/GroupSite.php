<?php


namespace Nemundo\Process\Group\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Group\Com\Admin\GroupAdmin;
use Nemundo\Process\Group\Com\Form\GroupUserForm;
use Nemundo\Process\Group\Com\ListBox\GroupTypeListBox;
use Nemundo\Process\Group\Data\Group\GroupCount;
use Nemundo\Process\Group\Data\Group\GroupPaginationReader;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\Process\Group\Parameter\GroupParameter;
use Nemundo\Process\Group\Parameter\GroupTypeParameter;
use Nemundo\User\Parameter\UserParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;
use Schleuniger\Site\Test\TestSite;

class GroupSite extends AbstractSite
{

    /**
     * @var GroupSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title[LanguageCode::EN] = 'Group';
        $this->title[LanguageCode::DE] = 'Gruppen';
        $this->url = 'group';
        GroupSite::$site = $this;

        //new GroupUserDeleteSite($this);
        //new GroupContentViewSite($this);

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $admin=new GroupAdmin($page);




        $page->render();

    }

}