<?php


namespace Nemundo\Process\Template\Content\User;


use App\App\Group\Builder\GroupUserBuilder;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\User\Data\User\UserReader;

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


        $builder = new GroupUserBuilder();
        $builder->email = $this->email;
        $builder->createUser();


        // TODO: Implement saveItem() method.
    }

}