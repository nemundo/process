<?php

namespace Nemundo\Process\App\Feed\Install;

use Nemundo\App\Scheduler\Setup\SchedulerSetup;
use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Feed\Content\Item\FeedItemContentType;
use Nemundo\Process\App\Feed\Content\Feed\FeedContentType;
use Nemundo\Process\App\Feed\Data\FeedCollection;
use Nemundo\Process\App\Feed\Scheduler\FeedImportScheduler;
use Nemundo\Process\App\Feed\Script\FeedCleanScript;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class FeedInstall extends AbstractInstall
{
    public function install()
    {


        (new ModelCollectionSetup())
            ->addCollection(new FeedCollection());

        (new SchedulerSetup())
            ->addScheduler(new FeedImportScheduler());

        (new ScriptSetup())
        ->addScript(new FeedCleanScript());


        (new ContentTypeSetup())
            ->addContentType(new FeedContentType())
            ->addContentType(new FeedItemContentType());


    }
}