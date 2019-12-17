<?php


namespace Nemundo\Process\App\Inbox\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Inbox\Data\InboxCollection;
use Nemundo\Process\App\Inbox\Script\InboxCleanScript;
use Nemundo\Project\Install\AbstractInstall;
use Nemundo\Project\Install\AbstractUninstall;

class InboxUninstall extends AbstractUninstall
{

    public function uninstall()
    {


        $setup = new ModelCollectionSetup();
         $setup->removeCollection(new InboxCollection());

    }

}