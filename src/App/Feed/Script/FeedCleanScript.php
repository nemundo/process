<?php


namespace Nemundo\Process\App\Feed\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\App\Feed\Content\Feed\FeedContentType;
use Nemundo\Process\App\Feed\Content\Item\FeedItemContentType;
use Nemundo\Process\App\Feed\Data\Feed\FeedReader;
use Nemundo\Process\App\Feed\Data\FeedItem\FeedItemReader;

class FeedCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName='feed-clean';
    }


    public function run()
    {


        $reader=new FeedItemReader();
        foreach ($reader->getData() as $feedItemRow) {
            (new FeedItemContentType($feedItemRow->id))->deleteType();
        }

        $reader=new FeedReader();
        foreach ($reader->getData() as $feedItemRow) {
            (new FeedContentType($feedItemRow->id))->deleteType();
        }





    }

}