<?php


namespace Nemundo\Process\App\Feed\Scheduler;


use Nemundo\App\Scheduler\Job\AbstractScheduler;
use Nemundo\Process\App\Feed\Content\Feed\FeedContentType;
use Nemundo\Process\App\Feed\Content\Item\FeedItemContentType;
use Nemundo\Process\App\Feed\Data\Feed\FeedReader;
use Nemundo\Rss\RssReader;


class FeedImportScheduler extends AbstractScheduler
{

    protected function loadScript()
    {
        parent::loadScript(); // TODO: Change the autogenerated stub

        $this->consoleScript = true;
        $this->scriptName = 'feed-import';

    }


    public function run()
    {
        // TODO: Implement run() method.

        $reader = new FeedReader();
        foreach ($reader->getData() as $feedRow) {


            //(new Debug())->write($feedRow->feedUrl);

            $rssReader = new RssReader();
            $rssReader->feedUrl = $feedRow->feedUrl;

            $feedType = new FeedContentType();
            $feedType->title = $rssReader->getTitle();
            $feedType->feedUrl = $feedRow->feedUrl;
            $feedType->saveType();


            /*
            foreach ($rssReader->getData() as $rssItem) {


                //(new Debug())->write($rssItem->title);

                $itemType = new FeedItemContentType();
                $itemType->feedId = $feedType->getDataId();
                $itemType->title = $rssItem->title;
                $itemType->description = $rssItem->description;
                $itemType->url = $rssItem->url;
                $itemType->saveType();

            }*/

        }


    }

}