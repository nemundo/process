<?php


namespace Nemundo\Process\Template\Content\User;


use App\Usergroup\AppUsergroup;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Group\Data\GroupUser\GroupUser;
use Nemundo\Process\Group\Type\AbstractGroupContentType;
use Nemundo\User\Data\User\UserReader;
use Nemundo\User\Type\UserBuilder;

class UserContentItem extends AbstractContentItem
{

    public $email;

    public function getSubject()
    {

        $userRow = (new UserReader())->getRowById($this->dataId);
        return $userRow->login;

    }


    protected function saveData()
    {
        $this->contentType = new UserContentType();
        //$this->saveContent();

        $user = new UserBuilder();
        $user->login = $this->email;
        $user->email = $this->email;
        //$user->displayName = $this->vorname . ' ' . $this->name;
        $userId = $user->createUser();

        $user->addUsergroup(new AppUsergroup());

        $this->dataId = $user->userId;

        $this->addSearchWord($this->email);


        // TODO: Implement saveItem() method.
    }


    public function addGroup(AbstractGroupContentType $group)
    {


        $data = new GroupUser();
        $data->ignoreIfExists = true;
        $data->groupId = $group->typeId;
        $data->userId = $this->dataId;
        $data->save();

        return $this;


    }


}