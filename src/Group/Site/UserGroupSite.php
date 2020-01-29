<?php


namespace Nemundo\Process\Group\Site;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
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
   $this->url='user-group';

   UserGroupSite::$site=$this;

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $form = new SearchForm($page);

        $user = new UserListBox($form);
        $user->searchMode=true;
        $user->submitOnChange=true;

        $userParameter = new UserParameter();
        if ($userParameter->exists()) {

            $userId = $userParameter->getValue();

            $table = new AdminTable($page);

            $reader = new GroupUserReader();
            $reader->model->loadGroup();
            $reader->filter->andEqual($reader->model->userId,$userId);
            foreach ($reader->getData() as $groupUserRow) {
                $row = new TableRow($table);
                $row->addText($groupUserRow->group->group);
            }

            $form = new UserGroupForm($page);
            $form->userId = $userId;
            $form->redirectSite =new Site();  // UserGroupSite::$site;


        }


        $page->render();

        // TODO: Implement loadContent() method.
    }

}