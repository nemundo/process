<?php


namespace Nemundo\Process\User\Content;


use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Random\UniqueId;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Group\Data\Group\GroupRow;
use Nemundo\Process\Group\Data\GroupUser\GroupUser;
use Nemundo\Process\Group\Data\GroupUser\GroupUserReader;
use Nemundo\Process\Group\Type\AbstractGroupContentType;
use Nemundo\Process\Group\Type\GroupIndexTrait;
use Nemundo\Process\Group\Type\UserGroupType;
use Nemundo\User\Data\User\User;
use Nemundo\User\Data\User\UserCount;
use Nemundo\User\Data\User\UserId;
use Nemundo\User\Data\User\UserReader;
use Nemundo\User\Data\User\UserUpdate;
use Nemundo\User\Data\Usergroup\UsergroupCount;
use Nemundo\User\Data\UserUsergroup\UserUsergroup;
use Nemundo\User\Usergroup\AbstractUsergroup;


abstract class AbstractUserContentType extends AbstractTreeContentType
{

    use GroupIndexTrait;

    /**
     * @var bool
     */
    public $active = true;

    /**
     * @var string
     */
    public $login;

    /**
     * @var string
     */
    public $displayName;

    /**
     * @var string
     */
    public $email;


    /*
    protected function loadContentType()
    {

        $this->typeLabel = 'User';
        $this->typeId = '8ef8e1d2-0c15-45b0-ba10-7c306d617406';
        $this->viewClass = UserContentView::class;
        $this->formClass=UserContentForm::class;
        $this->adminClass=UserContentAdmin::class;

    }*/


    public function fromLogin($login)
    {

        $id = new UserId();
        $id->filter->andEqual($id->model->login, $login);
        $this->dataId = $id->getId();

        /*
        if (!$this->userId == '') {
            $this->loadData();
        } else {
            // (new LogMessage())->writeError('Login not found');
        }*/


        return $this;

    }



    public function saveType()
    {

        if ($this->existItem()) {
            $id = new UserId();
            $id->filter->andEqual($id->model->login, $this->login);
            $this->dataId = $id->getId();

            //$this->createMode = false;

        }

        //if (!$this->existItem()) {
        parent::saveType();
        //}
    }

    protected function onCreate()
    {

        //$builder=new UserBuilder();


        /*$displayName = $this->displayName;
        if ($displayName == null) {
            $displayName = $this->login;
        }*/

        /*$count = new UserCount();
        $count->filter->andEqual($count->model->login, $this->login);
        if ($count->getCount() == 0) {*/

        $this->dataId = (new UniqueId())->getUniqueId();

        $data = new User();
        $data->id = $this->dataId;
        // $data->ignoreIfExists = true;
        $data->active = $this->active;
        $data->login = $this->login;
        $data->email = $this->email;
        //$data->displayName = $displayName;
        $data->secureToken = (new UniqueId())->getUniqueId();
        $data->save();


    }


    protected function onUpdate()
    {

        //getDataId überschreiben

        /*$displayName = $this->displayName;
        if ($displayName == null) {
            $displayName = $this->login;
        }*/

        $update = new UserUpdate();
        $update->active = $this->active;
        $update->email = $this->email;
        //$update->displayName = $displayName;
        $update->updateById($this->dataId);


    }


    protected function onIndex()
    {


        parent::onIndex();


        $update = new UserUpdate();
        $update->displayName = $this->getSubject();
        $update->updateById($this->dataId);




        $this->saveGroupIndex();
        $this->addUser($this->dataId);


        //$this->up


        /*
        $type = new UserGroupType();
        $type->groupId = $this->dataId;

        $type->addUser($this->dataId);
        $type->saveType();*/

    }


    public function existItem()
    {
        $value = false;
        $count = new UserCount();
        $count->filter->andEqual($count->model->login, $this->login);
        if ($count->getCount() == 1) {
            $value = true;
        }

        return $value;

    }


    /*
    public function getDataRow()
    {

       return (new UserReader())->getRowById($this->dataId);
    }*/


    /*
    public function getSubject()
    {

        $userRow = (new UserReader())->getRowById($this->dataId);
        return $userRow->login;

    }*/


    public function getGroupLabel()
    {

        return $this->getDataRow()->displayName;

        // TODO: Implement getGroupLabel() method.
    }



    // getUserGroupId
    /*public function getGroupId()
    {

        $groupId = null;

        $reader = new GroupUserReader();
        $reader->model->loadGroup();
        $reader->filter->andEqual($reader->model->group->groupTypeId, (new UserGroupType())->typeId);
        $reader->filter->andEqual($reader->model->userId, $this->dataId);
        foreach ($reader->getData() as $groupUserRow) {
            $groupId = $groupUserRow->groupId;
        }

        if ($groupId == null) {
            (new LogMessage())->writeError('No User Group Id');
        }


        return $groupId;

    }*/


    // getGroupList
    public function getGroupMembershipList()
    {

        /** @var GroupRow[] $list */
        $list = [];

        $reader = new GroupUserReader();
        $reader->model->loadGroup();
        $reader->model->group->loadGroupType();
        $reader->filter->andEqual($reader->model->userId, $this->dataId);
        $reader->addOrder($reader->model->group->group);
        foreach ($reader->getData() as $groupUserRow) {
            $list[] = $groupUserRow->group;
        }

        return $list;

    }

    public function getGroupIdList()
    {

        $list = [];

        $reader = new GroupUserReader();
        $reader->filter->andEqual($reader->model->userId, $this->dataId);
        foreach ($reader->getData() as $groupUserRow) {
            $list[] = $groupUserRow->groupId;
        }

        return $list;
    }


    public function addUsergroup(AbstractUsergroup $usergroup)
    {

            $data = new UserUsergroup();
            $data->ignoreIfExists = true;
            $data->userId = $this->dataId;
            $data->usergroupId = $usergroup->usergroupId;
            $data->save();

        return $this;

    }


    public function addGroup(AbstractGroupContentType $group) {

        $data = new GroupUser();
        $data->ignoreIfExists = true;
        $data->groupId = $group->getGroupId();
        $data->userId = $this->dataId;
        $data->save();

        return $this;

    }

}