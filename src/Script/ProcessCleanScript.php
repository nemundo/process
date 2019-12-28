<?php


namespace Nemundo\Process\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Install\ProcessInstall;
use Nemundo\Process\Install\ProcessUninstall;
use Nemundo\SwissPost\Data\SwissPostCollection;
use Nemundo\SwissPost\Install\SwissPostInstall;
use Schleuniger\Setup\SchleunigerSetup;

class ProcessCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'process-clean';
    }


    public function run()
    {

        $setup=new ModelCollectionSetup();
        $setup->removeCollection(new SwissPostCollection());



        (new ProcessUninstall())->uninstall();
        (new ProcessInstall())->install();

        //(new SchleunigerSetup())->run();

    }

}