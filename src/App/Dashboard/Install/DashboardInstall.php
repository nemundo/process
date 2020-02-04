<?php


namespace Nemundo\Process\App\Dashboard\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Dashboard\Data\DashboardCollection;
use Nemundo\Process\App\Dashboard\Setup\DashboardSetup;
use Nemundo\Project\Install\AbstractInstall;
use Nemundo\Srf\Content\Livestream\SrfLivestreamContentType;
use Nemundo\Srf\Data\RadioLivestream\RadioLivestreamReader;

class DashboardInstall extends AbstractInstall
{

    public function install()
    {

        $setup=new ModelCollectionSetup();
        $setup->addCollection(new DashboardCollection());


        /*

        $reader = new RadioLivestreamReader();
        foreach ($reader->getData() as $livestreamRow) {

            $type = new SrfLivestreamContentType($livestreamRow->id);

            $setup = new DashboardSetup();
            $setup->addDashboard($type);
        }*/



        // TODO: Implement install() method.
    }

}