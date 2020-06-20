<?php


namespace Nemundo\Process\App\Feed\Application;


use Nemundo\App\Application\Type\AbstractApplication;
use Nemundo\Process\App\Feed\Data\FeedCollection;

class FeedApplication extends AbstractApplication
{

    protected function loadApplication()
    {

        $this->application = 'Feed';
        $this->applicationId = 'bad8be7d-ef62-4d24-a67c-967f423f5f85';
        $this->modelCollectionClass = FeedCollection::class;

    }

}