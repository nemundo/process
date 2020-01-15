<?php


namespace Nemundo\Process\Search\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Search\Data\SearchCollection;
use Nemundo\Project\Install\AbstractClean;

class SearchClean extends AbstractClean
{

    public function cleanData()
    {

        $setup = new ModelCollectionSetup();
        $setup->removeCollection(new SearchCollection());

        (new SearchInstall())->install();


    }

}