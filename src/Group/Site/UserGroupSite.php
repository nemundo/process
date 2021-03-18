<?php


namespace Nemundo\Process\Group\Site;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Admin\Com\Table\AdminTableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Process\Group\Com\Form\GroupUserForm;
use Nemundo\Process\Group\Com\Form\UserGroupForm;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\User\Com\ListBox\UserListBox;
use Nemundo\User\Parameter\UserParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class UserGroupSite extends AbstractSite
{

    /**
     * @var UserGroupSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'User Group';
//        $this->title = 'User Group';

        $this->url = 'user-group';

        UserGroupSite::$site = $this;

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $layout = new BootstrapTwoColumnLayout($page);


        $form = new SearchForm($layout->col1);

        $user = new UserListBox($form);
        $user->searchMode = true;
        $user->submitOnChange = true;

        $userParameter = new UserParameter();
        if ($userParameter->exists()) {

            $userId = $userParameter->getValue();




            $groupUserReader = new GroupUserReader();
            $groupUserReader->model->loadGroup();
            $groupUserReader->model->group->loadGroupType();
            $groupUserReader->filter->andEqual($groupUserReader->model->userId, $userId);

            $table = new AdminTable($layout->col2);

            $header = new AdminTableHeader($table);
            $header->addText($groupUserReader->model->group->label);
            $header->addText($groupUserReader->model->group->groupType->label);

            foreach ($groupUserReader->getData() as $groupUserRow) {
                $row = new TableRow($table);
                $row->addText($groupUserRow->group->group);
                $row->addText($groupUserRow->group->groupType->contentType);
            }

            $form = new UserGroupForm($layout->col2);
            $form->userId = $userId;
            $form->redirectSite = new Site();  // UserGroupSite::$site;



        }


        $page->render();

        // TODO: Implement loadContent() method.
    }

}