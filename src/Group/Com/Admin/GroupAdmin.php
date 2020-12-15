<?php


namespace Nemundo\Process\Group\Com\Admin;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Html\Formatting\Bold;
use Nemundo\Html\Table\Th;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Group\Com\Form\GroupUserForm;
use Nemundo\Process\Group\Com\GroupContentTypeTrait;
use Nemundo\Process\Group\Com\ListBox\GroupTypeListBox;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Data\GroupType\GroupTypeReader;
use Nemundo\Process\Group\Data\GroupUser\GroupUserDelete;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\Process\Group\Parameter\GroupParameter;
use Nemundo\Process\Group\Type\AbstractGroupContentType;
use Nemundo\User\Parameter\UserParameter;
use Nemundo\Web\Action\AbstractActionPanel;
use Nemundo\Web\Action\ActionSite;
use Nemundo\Web\Action\Site\DeleteActionSite;
use Nemundo\Web\Site\Site;
use Nemundo\Core\Http\Url\UrlReferer;

class GroupAdmin extends AbstractActionPanel
{

    use GroupContentTypeTrait;

    /**
     * @var bool
     */
    public $showGroupTypeColumn = true;

    /**
     * @var bool
     */
    public $filterGroupType = true;

    /**
     * @var AbstractGroupContentType[]
     */
    private $groupList = [];


    /**
     * @var ActionSite
     */
    private $index;

    /**
     * @var ActionSite
     */
    private $deleteUser;


    public function addGroup(AbstractGroupContentType $group)
    {

        $this->groupList[] = $group;
        return $this;

    }


    //public function addAllGroupType()
    //{


        /*
        $reader = new GroupTypeReader();
        $reader->model->loadGroupType();
        $reader->addOrder($reader->model->groupType->contentType);
        foreach ($reader->getData() as $groupTypeRow) {

            //$groupType = $groupTypeRow->groupType->getContentType();

            //$this->addGroupType($groupType);

        }*/


    //}


    protected function loadActionSite()
    {

        $this->index = new ActionSite($this);
        $this->index->onAction = function () {

            $layout = new BootstrapTwoColumnLayout($this);

            $groupReader = new GroupReader();
            $groupReader->model->loadGroupType();

            //if ($this->filterGroupType) {
            $form = new SearchForm($layout->col1);

            $formRow = new BootstrapFormRow($form);

            $groupType =new GroupTypeListBox($formRow);
            //$groupType = new GroupTypeListBox($formRow);
            $groupType->searchMode = true;
            $groupType->submitOnChange = true;

            $reader = new GroupTypeReader();
            $reader->model->loadGroupType();
            $reader->addOrder($reader->model->groupType->contentType);

            /*
            foreach ($reader->getData() as $groupTypeRow) {
                $groupTypethis->addItem($groupTypeRow->groupTypeId, $groupTypeRow->groupType->contentType);
            }*/


            /*foreach ($this->groupContentTypeList as $groupContentType) {
                //foreach ($this->groupList as $groupContentType) {
                //$groupType->addItem($groupContentType->typeId, $groupContentType->typeLabel);
            }*/

            if ($groupType->hasValue()) {
                $groupReader->filter->andEqual($groupReader->model->groupTypeId, $groupType->getValue());
            }

            //}


            $table = new AdminClickableTable($layout->col1);

            $header = new TableHeader($table);
            $header->addText($groupReader->model->active->label);
            $header->addText($groupReader->model->id->label);



            $th = new Th($header);
            $th->content[LanguageCode::EN] = 'Group';
            $th->content[LanguageCode::DE] = 'Gruppe';

            if ($this->showGroupTypeColumn) {
                $header->addText('Group Type');
            }


            foreach ($this->groupContentTypeList as $groupContentType) {
                $groupReader->filter->orEqual($groupReader->model->groupTypeId, $groupContentType->typeId);
            }

            foreach ($this->groupList as $group) {
                $groupReader->filter->orEqual($groupReader->model->id, $group->getGroupId());
            }


            $groupReader->addOrder($groupReader->model->group);
            foreach ($groupReader->getData() as $groupRow) {

                $row = new BootstrapClickableTableRow($table);

                $row->addYesNo($groupRow->active);
                $row->addText($groupRow->id);

                if ((new GroupParameter())->getValue() == $groupRow->id) {
                    $bold = new Bold($row);
                    $bold->content = $groupRow->group;
                } else {
                    $row->addText($groupRow->group);
                }


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
                $form->redirectSite = new Site();


                $table = new AdminTable($layout->col2);

                $header = new TableHeader($table);

                $th = new Th($header);
                $th->content[LanguageCode::EN] = 'User';
                $th->content[LanguageCode::DE] = 'Benutzer';


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
                    $row->addIconSite($site);

                }


            }

        };

        $this->deleteUser = new  DeleteActionSite($this);
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