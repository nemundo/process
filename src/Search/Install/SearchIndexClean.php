<?php


namespace Nemundo\Process\Search\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Search\Content\Log\SearchLogContentType;
use Nemundo\Process\Search\Data\SearchCollection;
use Nemundo\Project\Install\AbstractClean;

class SearchIndexClean extends AbstractClean
{

    public function cleanData()
    {


        $setup = new ContentTypeSetup();
        $setup->removeContent(new SearchLogContentType());


        $setup = new ModelCollectionSetup();
        $setup->removeCollection(new SearchCollection());

        (new SearchInstall())->install();


    }

}