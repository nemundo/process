<?php


namespace Nemundo\Process\App\Inbox\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Inbox\Data\InboxCollection;
use Nemundo\Process\App\Inbox\Script\InboxCleanScript;
use Nemundo\Project\Install\AbstractInstall;

class InboxInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
         $setup->addCollection(new InboxCollection());

         $setup = new ScriptSetup();
         $setup->addScript(new InboxCleanScript());

    }

}