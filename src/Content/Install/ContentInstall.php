<?php


namespace Nemundo\Process\Content\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Content\Data\ContentCollection;
use Nemundo\Process\Content\Script\ContentCheckScript;
use Nemundo\Process\Content\Script\ContentCleanScript;
use Nemundo\Process\Content\Script\ContentUpdateScript;
use Nemundo\Project\Install\AbstractInstall;

class ContentInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new ContentCollection());

        $setup=new ScriptSetup();
        $setup->addScript(new ContentUpdateScript());
        $setup->addScript(new ContentCheckScript());

        (new ContentTestInstall())->install();

    }

}