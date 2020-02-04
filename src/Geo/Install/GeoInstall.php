<?php


namespace Nemundo\Process\Geo\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Geo\Data\GeoCollection;
use Nemundo\Project\Install\AbstractInstall;

class GeoInstall extends AbstractInstall
{

    public function install()
    {

        $setup=new ModelCollectionSetup();
        $setup->addCollection(new GeoCollection());


    }

}