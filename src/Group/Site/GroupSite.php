<?php


namespace Nemundo\Process\Group\Site;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Process\Group\Com\GroupListBox;
use Nemundo\Process\Group\Content\GroupContentForm;
use Nemundo\Process\Group\Content\GroupUserForm;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\Process\Group\Parameter\GroupParameter;
use Nemundo\User\Data\Usergroup\UsergroupReader;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class GroupSite extends AbstractSite
{

    /**
     * @var GroupSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Group';
        $this->url = 'group';
        GroupSite::$site=$this;

        new GroupItemSite($this);

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $layout = new BootstrapTwoColumnLayout($page);

        $search = new SearchForm($layout->col1);

        $listbox = new GroupListBox($search);  // new BootstrapListBox($search);
        //$listbox->name = (new GroupParameter())->getParameterName();
        $listbox->submitOnChange = true;
        $listbox->searchItem = true;
        $listbox->emptyValueAsDefault=false;
        /*$reader = new GroupReader();
        foreach ($reader->getData() as $groupRow) {
            $listbox->addItem($groupRow->id, $groupRow->group);
        }*/


        $groupParameter=new GroupParameter();
        if ($groupParameter->hasValue()) {

            $groupId = $groupParameter->getValue();

            $form = new GroupUserForm($layout->col1);
            $form->groupId = $groupId;
            $form->redirectSite = GroupSite::$site;
            $form->redirectSite->addParameter($groupParameter);

            //$form->redirectSite = new Site();


            $groupRow = (new GroupReader())->getRowById($groupId);

            $title = new AdminTitle($layout->col1);
            $title->content = $groupRow->group;


            $table = new AdminTable($layout->col1);

            $reader = new GroupUserReader();
            $reader->model->loadUser();
            $reader->filter->andEqual($reader->model->groupId,$groupId );
            foreach ($reader->getData() as $groupUserRow) {
                $row = new TableRow($table);
                $row->addText($groupUserRow->user->displayName);
            }

        }


        $form = new GroupContentForm($layout->col2);




        $table=new AdminTable($layout->col2);

        $header=new TableHeader($table);
        $header->addText('Group');
        $header->addText('Group Type');

        $reader=new GroupReader();
        $reader->model->loadGroupType();
        foreach ($reader->getData() as $groupRow) {
            $row=new TableRow($table);
            $row->addText($groupRow->group);
            $row->addText($groupRow->groupType->groupType);
        }




        $page->render();

    }

}