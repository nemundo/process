<?php


namespace Nemundo\Process\Script;


use App\Crawler\Event\SchuurCrawler;
use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Structure\ForLoop;
use Nemundo\Process\App\Plz\Import\PlzImport;
use Nemundo\Process\Group\Content\GroupContentItem;
use Nemundo\Process\Group\Type\PublicGroup;
use Nemundo\Process\Template\Content\Event\EventContentDelete;
use Nemundo\Process\Template\Content\User\UserContentItem;
use Nemundo\SwissPost\Install\SwissPostInstall;

class ProcessTestScript extends AbstractConsoleScript
{
    protected function loadScript()
    {
   $this->scriptName='process-test';
    }

    public function run()
    {


        (new EventContentDelete())->delete();



        //(new PlzImport())->import();

        (new SchuurCrawler())->startCrawler();


        //(new SwissPostInstall())->install();
        //(new \Nemundo\SwissPost\Import\PolitischeGemeindeImport())->import();





        /*
        $loop=new ForLoop();
        $loop->minNumber = 1;
        $loop->maxNumber=10;
        foreach ($loop->getData() as $number){


            $email =  'c'.$number.'@test.com';

            $item=new UserContentItem();
            $item->email = $email;
            $item->saveItem();
            $item->addGroup(new PublicGroup());

            $groupItem = new GroupContentItem();
            $groupItem->group=$email;
            $groupItem->saveItem();
            $groupItem->addUser($item->dataId);

        }*/

    }

}