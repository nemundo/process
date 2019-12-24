<?php


namespace Nemundo\Process\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Structure\ForLoop;
use Nemundo\Process\Group\Content\GroupContentItem;
use Nemundo\Process\Template\Content\User\UserContentItem;

class ProcessTestScript extends AbstractConsoleScript
{
    protected function loadScript()
    {
   $this->scriptName='process-test';
    }

    public function run()
    {


        $loop=new ForLoop();
        foreach ($loop->getData() as $number){


            $email =  'test'.$number.'@test.com';

            $item=new UserContentItem();
            $item->email = $email;
            $item->saveItem();

            $groupItem = new GroupContentItem();
            $groupItem->group=$email;
            $groupItem->saveItem();
            $groupItem->addUser($item->dataId);

        }

    }

}