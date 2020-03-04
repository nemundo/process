<?php


namespace Nemundo\Process\Group\Test;


use Nemundo\Dev\TestData\AbstractTestData;
use Nemundo\Process\Template\Content\User\UserContentType;

class UserTestData extends AbstractTestData
{

    protected function createItem($n)
    {

        $type = new UserContentType();
        $type->login = 'USER' . $n;
        $type->email = 'user' . $n . '@test.com';
        $type->saveType();

    }

}