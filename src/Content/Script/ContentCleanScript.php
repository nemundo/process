<?php


namespace Nemundo\Process\Content\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Install\ProcessInstall;
use Nemundo\Process\Install\ProcessUninstall;

class ContentCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'content-clean';
    }


    public function run()
    {

        (new ProcessUninstall())->uninstall();
        (new ProcessInstall())->install();
    }

}