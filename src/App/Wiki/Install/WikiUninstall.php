<?php


namespace Nemundo\Process\App\Wiki\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Wiki\Data\WikiCollection;
use Nemundo\Project\Install\AbstractUninstall;

class WikiUninstall extends AbstractUninstall
{

    public function uninstall()
    {

        $setup = new ModelCollectionSetup();
        $setup->removeCollection(new WikiCollection());
    }

}