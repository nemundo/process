<?php


namespace Nemundo\Process\App\Dashboard\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Dashboard\Data\DashboardCollection;
use Nemundo\Project\Install\AbstractInstall;


class DashboardInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new DashboardCollection());

    }

}