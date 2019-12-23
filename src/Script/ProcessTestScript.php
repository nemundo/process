<?php


namespace Nemundo\Process\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Structure\ForLoop;
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

            $item=new UserContentItem();
            $item->email = 'test'.$number.'@test.com';
            $item->saveItem();
        }

    }

}