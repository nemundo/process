<?php


namespace Nemundo\Process\Template\Content\User;


use App\App\Group\Builder\GroupUserBuilder;
use App\App\Group\Usergroup\GroupUsergroup;
use App\Usergroup\AppUsergroup;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\User\Data\User\UserReader;
use Nemundo\User\Type\UserBuilder;

class UserContentItem extends AbstractContentItem
{

    public $email;

    public function getSubject()
    {

        $userRow=(new UserReader())->getRowById($this->dataId);
        return $userRow->login;

    }


    public function saveItem()
    {
        $this->contentType=new UserContentType();
        $this->saveContent();

        $user = new UserBuilder();
        $user->login = $this->email;
        $user->email = $this->email;
        //$user->displayName = $this->vorname . ' ' . $this->name;
        $userId = $user->createUser();

        $user->addUsergroup(new AppUsergroup());

     $this->dataId= $user->userId;

        // TODO: Implement saveItem() method.
    }

}