<?php


namespace Nemundo\Process\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Data\ProcessCollection;
use Nemundo\Project\Install\AbstractUninnstall;

class ProcessUninstall extends AbstractUninnstall
{

    public function uninstall()
    {

        $setup = new ModelCollectionSetup();
        $setup->removeCollection(new ProcessCollection());


    }

}