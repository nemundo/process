<?php


namespace Nemundo\Process\App\Feed\Install;


use Nemundo\App\Application\Setup\ApplicationSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Feed\Application\FeedApplication;
use Nemundo\Process\App\Feed\Data\FeedCollection;
use Nemundo\Process\App\Feed\Script\FeedCleanScript;
use Nemundo\Project\Install\AbstractUninstall;

class FeedUninstall extends AbstractUninstall
{

    public function uninstall()
    {

        (new FeedCleanScript())->run();

        (new ModelCollectionSetup())
            ->removeCollection(new FeedCollection());

        (new ApplicationSetup())
            ->removeApplication(new FeedApplication());


    }

}