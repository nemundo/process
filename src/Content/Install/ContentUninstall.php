<?php


namespace Nemundo\Process\Content\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Content\Data\ContentCollection;
use Nemundo\Project\Install\AbstractInstall;

class ContentUninstall extends AbstractInstall
{

    public function install()
    {
        $setup = new ModelCollectionSetup();
        $setup->removeCollection(new ContentCollection());
    }

}