<?php


namespace Nemundo\Process\Content\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Content\Install\ContentInstall;
use Nemundo\Process\Content\Install\ContentUninstall;

class ContentCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'content-clean';
    }


    public function run()
    {

        (new ContentUninstall())->uninstall();
        (new ContentInstall())->install();

    }

}