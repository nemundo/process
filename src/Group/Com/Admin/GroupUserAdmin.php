<?php


namespace Nemundo\Process\Group\Com\Admin;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Group\Com\Form\GroupUserForm;
use Nemundo\Process\Group\Com\GroupContentTypeTrait;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Data\GroupUser\GroupUserDelete;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\Process\Group\Parameter\GroupParameter;
use Nemundo\Process\Group\Type\AbstractGroupContentType;
use Nemundo\User\Parameter\UserParameter;
use Nemundo\Web\Action\AbstractActionPanel;
use Nemundo\Web\Action\ActionSite;
use Nemundo\Core\Http\Url\UrlReferer;

class GroupUserAdmin extends AbstractActionPanel
{

    public $groupId;

    /**
     * @var ActionSite
     */
    private $index;

    /**
     * @var ActionSite
     */
    private $deleteUser;


    protected function loadActionSite()
    {


        $this->index = new ActionSite($this);
        $this->index->onAction = function () {


                $groupRow = (new GroupReader())->getRowById($this->groupId);

                $subtitle = new AdminSubtitle($this);
                $subtitle->content = $groupRow->group;

                $table = new AdminTable($this);

                $header = new TableHeader($table);
                $header->addText('User');
                $header->addEmpty();

                $groupReader = new GroupUserReader();
                $groupReader->model->loadUser();
                $groupReader->filter->andEqual($groupReader->model->groupId, $this->groupId);
                $groupReader->addOrder($groupReader->model->user->displayName);
                foreach ($groupReader->getData() as $groupUserRow) {
                    $row = new TableRow($table);
                    $row->addText($groupUserRow->user->displayName);

                    $site = clone($this->deleteUser);
                    $site->addParameter(new GroupParameter($groupUserRow->groupId));
                    $site->addParameter(new UserParameter($groupUserRow->userId));
                    $row->addSite($site);

                }

                $form = new GroupUserForm($this);
                $form->groupId = $this->groupId;



        };

        $this->deleteUser = new ActionSite($this);
        $this->deleteUser->title = 'Löschen';
        $this->deleteUser->actionName = 'delete-user';
        $this->deleteUser->onAction = function () {


            $groupId = (new GroupParameter())->getValue();
            $userId = (new UserParameter())->getValue();

            $delete = new GroupUserDelete();
            $delete->filter->andEqual($delete->model->groupId, $groupId);
            $delete->filter->andEqual($delete->model->userId, $userId);
            $delete->delete();

            (new UrlReferer())->redirect();


        };

    }

}