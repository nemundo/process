<?php


namespace Nemundo\Process\Content\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Content\Data\ContentCollection;
use Nemundo\App\Application\Type\Install\AbstractInstall;
use Nemundo\Project\Install\AbstractUninstall;

class ContentUninstall extends AbstractUninstall
{

    public function uninstall()
    {
        $setup = new ModelCollectionSetup();
        $setup->removeCollection(new ContentCollection());
    }

}