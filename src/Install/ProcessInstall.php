<?php


namespace Nemundo\Process\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Data\ProcessCollection;
use Nemundo\Project\Install\AbstractInstall;

class ProcessInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new ProcessCollection());

    }

}