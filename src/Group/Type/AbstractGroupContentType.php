<?php


namespace Nemundo\Process\Group\Type;


use Nemundo\Core\Directory\TextDirectory;
use Nemundo\Core\Random\UniqueId;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Group\Content\GroupContentForm;
use Nemundo\Process\Group\Content\GroupContentView;
use Nemundo\Process\Group\Data\Group\Group;
use Nemundo\Process\Group\Data\Group\GroupCount;
use Nemundo\Process\Group\Data\Group\GroupDelete;
use Nemundo\Process\Group\Data\Group\GroupReader;
use Nemundo\Process\Group\Data\GroupUser\GroupUser;
use Nemundo\Process\Group\Data\GroupUser\GroupUserDelete;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\Process\Group\Parameter\GroupParameter;
use Nemundo\Process\Group\Site\GroupContentViewSite;
use Nemundo\User\Reader\UserCustomRow;

abstract class AbstractGroupContentType extends AbstractTreeContentType
{

    protected $group;

    protected $groupId;

    /**
     * @var bool
     */
    protected $searchable = true;


    public function __construct($dataId = null)
    {

        $this->typeLabel = 'Content Group';
        $this->typeId = '8fb75394-3e0d-4a3e-a209-1a5ebfc46220';
        $this->formClass = GroupContentForm::class;
        $this->viewClass = GroupContentView::class;
        $this->viewSite = GroupContentViewSite::$site;
        $this->parameterClass = GroupParameter::class;

        $this->loadGroup();

        parent::__construct($dataId);

    }


    protected function loadGroup()
    {

    }


    protected function onCreate()
    {
        // nach saveType


        $this->saveGroup();

    }


    protected function saveGroup()
    {

        /*if ($this->dataId == null) {
            $this->dataId = (new UniqueId())->getUniqueId();
        }*/

        /*

        if ($this->group==null) {
          $this->group=$this->getSubject();
        }*/


        if ($this->groupId == null) {
            $this->groupId = (new UniqueId())->getUniqueId();
        }


        $data = new Group();
        $data->updateOnDuplicate = true;
        $data->id = $this->groupId;
        $data->group = $this->getGroupLabel();
        $data->groupTypeId = $this->typeId;  //groupType->id;
        $data->save();

    }


    public function saveType()
    {

        //$this->saveGroup();
        //parent::saveType();

        //   (new Debug())->write($this->dataId);

        if ($this->dataId !== null) {
            $count = new GroupCount();
//            $count->filter->andEqual($count->model->id, $this->dataId);
            $count->filter->andEqual($count->model->id, $this->groupId);

            if ($count->getCount() == 1) {
                $this->createMode = false;
            }
        }

        parent::saveType();

    }


    final protected function onSearchIndex()
    {

        if ($this->searchable) {
            $groupRow = $this->getGroupDataRow();
            $this->addSearchWord($groupRow->group);
        }

    }


    protected function onDelete()
    {

        // $delete = new GroupUserDelete();
        // $delete->

        (new GroupDelete())->deleteById($this->dataId);

    }


    protected function getGroupLabel()
    {

        $group = $this->group;
        if ($group == null) {
            $group = $this->getClassName();
        }

        return $group;

    }


    public function getGroupId() {


        if ($this->groupId == null) {
            $this->groupId = (new UniqueId())->getUniqueId();
        }

        return $this->groupId;

    }


    public function getGroupDataRow()
    {
        return (new GroupReader())->getRowById($this->groupId);
    }


    final public function getSubject()
    {

        return $this->getGroupDataRow()->group;

    }


    public function addUser($userId)
    {

        $data = new GroupUser();
        $data->ignoreIfExists = true;
        $data->groupId = $this->dataId;
        $data->userId = $userId;
        $data->save();

        return $this;

    }


    public function removeUser($userId)
    {


        $delete = new GroupUserDelete();
        $delete->filter->andEqual($delete->model->groupId, $this->dataId);
        $delete->filter->andEqual($delete->model->userId, $userId);
        $delete->delete();

        return $this;

    }


    public function getUserList()
    {

        /** @var UserCustomRow[] $list */
        $list = [];

        $reader = new GroupUserReader();
        $reader->model->loadUser();
        $reader->filter->andEqual($reader->model->groupId, $this->dataId);
        $reader->addOrder($reader->model->user->login);
        foreach ($reader->getData() as $groupUserRow) {
            $list[] = $groupUserRow->user;
        }

        return $list;

    }


    public function getUserIdList()
    {

        $list = [];

        $reader = new GroupUserReader();
        $reader->model->loadUser();
        $reader->filter->andEqual($reader->model->groupId, $this->dataId);

        foreach ($reader->getData() as $groupUserRow) {
            $list[] = $groupUserRow->userId;
        }

        return $list;

    }


    public function getUserListText()
    {

        $text = new TextDirectory();

        foreach ($this->getUserList() as $userRow) {
            $text->addValue($userRow->displayName);
        }

        return $text->getTextWithSeperator();

    }


}