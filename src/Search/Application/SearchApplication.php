<?php


namespace Nemundo\Process\Search\Application;


use Nemundo\App\Application\Type\AbstractApplication;
use Nemundo\Process\Search\Data\SearchCollection;

class SearchApplication extends AbstractApplication
{

    protected function loadApplication()
    {
        $this->application = 'Search';
        $this->applicationId = '05f06170-f360-4207-ab09-1c8d17370c77';
        $this->modelCollectionClass = SearchCollection::class;
    }

}