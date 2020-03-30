<?php


namespace Nemundo\Process\App\Podcast\Install;


use Nemundo\App\Scheduler\Setup\SchedulerSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Podcast\Content\Episode\EpisodeContentType;
use Nemundo\Process\App\Podcast\Content\Feed\FeedContentType;
use Nemundo\Process\App\Podcast\Data\PodcastCollection;
use Nemundo\Process\App\Podcast\Scheduler\PodcastScheduler;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class PodcastInstall extends AbstractInstall
{

    public function install()
    {

        (new ModelCollectionSetup())
            ->addCollection(new PodcastCollection());

        (new ContentTypeSetup())
            ->addContentType(new FeedContentType())
            ->addContentType(new EpisodeContentType());

        (new SchedulerSetup())
            ->addScheduler(new PodcastScheduler());


        // TODO: Implement install() method.
    }

}