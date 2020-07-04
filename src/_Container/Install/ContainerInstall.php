<?php

namespace Nemundo\Process\Container\Install;

use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Container\Data\ContainerCollection;
use Nemundo\Project\Install\AbstractInstall;

class ContainerInstall extends AbstractInstall
{
    public function install()
    {

        (new ModelCollectionSetup())->addCollection(new ContainerCollection());

    }
}