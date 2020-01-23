<?php


namespace Nemundo\Process\Group\Test;


use App\Usergroup\AppUsergroup;
use Nemundo\Core\Debug\Debug;
use Nemundo\Dev\TestData\AbstractTestData;
use Nemundo\Process\Template\Content\User\UserContentType;
use Nemundo\User\Type\UserBuilder;

class UserTestData extends AbstractTestData
{

    protected function createItem($n)
    {

        $type=new UserContentType();
        $type->login = 'USER'.$n;
        $type->email = 'user'.$n.'@test.com';
        $type->saveType();

        //(new Debug())->write($type->getDataId());

$builder = new UserBuilder($type->getDataId());
$builder->addUsergroup(new AppUsergroup());


    }

}