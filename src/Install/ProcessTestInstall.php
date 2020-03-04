<?php


namespace Nemundo\Process\Install;

use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Process\Content\Install\ContentTestInstall;
use Nemundo\Process\Content\Script\ContentUpdateScript;
use Nemundo\Process\Script\ProcessCleanScript;
use Nemundo\Process\Script\ProcessTestScript;
use Nemundo\Project\Install\AbstractInstall;

class ProcessTestInstall extends AbstractInstall
{

    public function install()
    {


        (new ContentTestInstall())->install();


        $setup = new ScriptSetup();
        $setup->addScript(new ProcessCleanScript());
        $setup->addScript(new ProcessTestScript());
        $setup->addScript(new ContentUpdateScript());


    }

}