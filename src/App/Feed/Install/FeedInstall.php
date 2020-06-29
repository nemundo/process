<?php

namespace Nemundo\Process\App\Feed\Install;

use Nemundo\App\Application\Setup\ApplicationSetup;
use Nemundo\App\Scheduler\Setup\SchedulerSetup;
use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Feed\Application\FeedApplication;
use Nemundo\Process\App\Feed\Content\Feed\FeedContentType;
use Nemundo\Process\App\Feed\Content\Item\FeedItemContentType;
use Nemundo\Process\App\Feed\Data\FeedCollection;
use Nemundo\Process\App\Feed\Scheduler\FeedImportScheduler;
use Nemundo\Process\App\Feed\Script\FeedCleanScript;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class FeedInstall extends AbstractInstall
{
    public function install()
    {

        (new ApplicationSetup())
            ->addApplication(new FeedApplication());

        (new ModelCollectionSetup())
            ->addCollection(new FeedCollection());

        (new SchedulerSetup(new FeedApplication()))
            ->addScheduler(new FeedImportScheduler());

        (new ScriptSetup())
            ->addScript(new FeedCleanScript());

        (new ContentTypeSetup(new FeedApplication()))
            ->addContentType(new FeedContentType())
            ->addContentType(new FeedItemContentType());

    }
}