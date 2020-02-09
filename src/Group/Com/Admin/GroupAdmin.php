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
use Nemundo\User\Parameter\UserParameter;
use Nemundo\Web\Action\AbstractActionPanel;
use Nemundo\Web\Action\ActionSite;
use Nemundo\Web\Site\Site;
use Nemundo\Web\Url\UrlReferer;

class GroupAdmin extends AbstractActionPanel
{

    use GroupContentTypeTrait;

    /**
     * @var bool
     */
    public $showGroupTypeColumn = true;

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

            $layout = new BootstrapTwoColumnLayout($this);


            $table = new AdminClickableTable($layout->col1);

            $header = new TableHeader($table);
            $header->addText('Group');

            if ($this->showGroupTypeColumn) {
                $header->addText('Group Type');
            }

            $groupReader = new GroupReader();
            $groupReader->model->loadGroupType();

            foreach ($this->groupContentTypeList as $groupContentType) {
                $groupReader->filter->orEqual($groupReader->model->groupTypeId, $groupContentType->typeId);
            }

            $groupReader->addOrder($groupReader->model->group);
            foreach ($groupReader->getData() as $groupRow) {

                $row = new BootstrapClickableTableRow($table);
                $row->addText($groupRow->group);

                if ($this->showGroupTypeColumn) {
                    $row->addText($groupRow->groupType->contentType);
                }

                $site = clone($this->index);
                $site->addParameter(new GroupParameter($groupRow->id));
                $row->addClickableSite($site);

            }

            $groupParameter = new GroupParameter();
            if ($groupParameter->exists()) {

                $groupId = $groupParameter->getValue();

                $groupRow = (new GroupReader())->getRowById($groupId);

                $subtitle = new AdminSubtitle($layout->col2);
                $subtitle->content = $groupRow->group;

                $form = new GroupUserForm($layout->col2);
                $form->groupId = $groupId;
                $form->redirectSite=new Site();


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

                    $site = clone($this->deleteUser);
                    $site->addParameter(new GroupParameter($groupUserRow->groupId));
                    $site->addParameter(new UserParameter($groupUserRow->userId));
                    $row->addSite($site);

                }


            }

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