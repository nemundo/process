<?php


namespace Nemundo\Process\App\Video\Application;


use Nemundo\App\Application\Type\AbstractApplication;
use Nemundo\Process\App\Video\Data\VideoCollection;

class VideoApplication extends AbstractApplication
{

    protected function loadApplication()
    {
        $this->application = 'Video';
        $this->applicationId = 'a9755913-5b08-4546-a338-ae059c561447';
        $this->modelCollectionClass=VideoCollection::class;
    }

}