<?php


namespace Nemundo\Process\Index\Install;


use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Process\Index\Script\CleanIndexScript;
use Nemundo\Process\Index\Script\ReIndexScript;
use Nemundo\App\Application\Type\Install\AbstractInstall;

class IndexInstall extends AbstractInstall
{

    public function install()
    {

        (new ScriptSetup())
            ->addScript(new CleanIndexScript())
            ->addScript(new ReIndexScript());

    }

}