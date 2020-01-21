<?php


namespace Nemundo\Process\Content\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Process\Content\Script\ContentCleanScript;
use Nemundo\Project\Install\AbstractInstall;

class ContentTestInstall extends AbstractInstall
{

    public function install()
    {
        // TODO: Implement install() method.

        $setup=new ScriptSetup();
        $setup->addScript(new ContentCleanScript());

    }

}