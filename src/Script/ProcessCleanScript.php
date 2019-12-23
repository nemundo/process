<?php


namespace Nemundo\Process\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Install\ProcessInstall;
use Nemundo\Process\Install\ProcessUninstall;
use Schleuniger\Setup\SchleunigerSetup;

class ProcessCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'process-clean';
    }


    public function run()
    {

        (new ProcessUninstall())->uninstall();
        (new ProcessInstall())->install();

        //(new SchleunigerSetup())->run();

    }

}