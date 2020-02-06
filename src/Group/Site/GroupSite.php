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
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Group\Com\Form\GroupUserForm;
use Nemundo\Process\Group\Com\ListBox\GroupTypeListBox;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\Process\Group\Parameter\GroupParameter;
use Nemundo\Process\Group\Parameter\GroupTypeParameter;
use Nemundo\User\Parameter\UserParameter;
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

        $this->title[LanguageCode::EN] = 'Group';
        $this->title[LanguageCode::DE]='Gruppen';
        $this->url = 'group';
        GroupSite::$site = $this;

        new GroupUserDeleteSite($this);
        new GroupContentViewSite($this);
        //new GroupItemSite($this);

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        /*
        $table=new AdminTable($page);

        $reader = new GroupReader();
        $reader->model->loadGroupType();
        foreach ($reader->getData() as $groupRow) {
            $row=new TableRow($table);
            $row->addText($groupRow->group);
            $row->addText($groupRow->groupType->contentType);
        }*/


        $layout = new BootstrapTwoColumnLayout($page);


        $form = new SearchForm($layout->col1);

        $formRow = new BootstrapFormRow($form);

        $groupType = new GroupTypeListBox($formRow);
        $groupType->searchMode = true;
        $groupType->submitOnChange = true;


        // group type (distinct)


        $table = new AdminClickableTable($layout->col1);

        $header = new TableHeader($table);
        $header->addText('Id');
        $header->addText('Group');
        $header->addText('Group Type');

        $groupReader = new GroupReader();
        $groupReader->model->loadGroupType();

        if ($groupType->hasValue()) {
            $groupReader->filter->andEqual($groupReader->model->groupTypeId, $groupType->getValue());
        }


        $groupReader->addOrder($groupReader->model->group);
        foreach ($groupReader->getData() as $groupRow) {
            $row = new BootstrapClickableTableRow($table);
            $row->addText($groupRow->id);
            $row->addText($groupRow->group);
            $row->addText($groupRow->groupType->contentType);

            $site = clone(GroupSite::$site);
            $site->addParameter(new GroupParameter($groupRow->id));
            $site->addParameter(new GroupTypeParameter());
            $row->addClickableSite($site);

        }


        $groupParameter = new GroupParameter();
        if ($groupParameter->exists()) {

            $groupId = $groupParameter->getValue();

            $groupRow = (new GroupReader())->getRowById($groupId);

            $subtitle = new AdminSubtitle($layout->col2);
            $subtitle->content = $groupRow->group;


            $form=new GroupUserForm($layout->col2);
            $form->groupId=$groupId;
            $form->redirectSite = new Site();


            $table = new AdminTable($layout->col2);

            $header = new TableHeader($table);
            $header->addText('User');
            $header->addEmpty();

            $groupReader = new GroupUserReader();
            $groupReader->model->loadUser();
            $groupReader->filter->andEqual($groupReader->model->groupId, $groupId);
            $groupReader->addOrder($groupReader->model->user->displayName);
            foreach ($groupReader->getData() as $groupUserRow) {
                $row = new TableRow($table);
                $row->addText($groupUserRow->user->displayName);

                $site=clone(GroupUserDeleteSite::$site);
                $site->addParameter(new GroupParameter());
                $site->addParameter(new UserParameter($groupUserRow->userId));
                $row->addIconSite($site);

            }


        }


        /*

        $search = new SearchForm($layout->col1);

        $listbox = new GroupListBox($search);  // new BootstrapListBox($search);
        //$listbox->name = (new GroupParameter())->getParameterName();
        $listbox->submitOnChange = true;
        $listbox->searchMode = true;
        $listbox->emptyValueAsDefault=false;
        /*$reader = new GroupReader();
        foreach ($reader->getData() as $groupRow) {
            $listbox->addItem($groupRow->id, $groupRow->group);
        }*/


        /*
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


        /*
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
*/


        $page->render();

    }

}