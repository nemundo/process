<?php


namespace Nemundo\Process\Template\Test;


use Nemundo\Dev\TestData\AbstractTestData;
use Nemundo\Process\Template\Content\User\UserContentType;

class UserTestData extends AbstractTestData
{

    protected function createItem($n)
    {

        $type=new UserContentType();
        $type->login = 'USER'.$n;
        $type->saveType();

        // TODO: Implement createItem() method.
    }

}