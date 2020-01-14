<?php


namespace Nemundo\Process\Search\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Search\Content\Log\SearchLogContentType;
use Nemundo\Process\Search\Data\SearchCollection;
use Nemundo\Project\Install\AbstractInstall;

class SearchInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new SearchCollection());

        $setup=new ContentTypeSetup();
        $setup->addContentType(new SearchLogContentType());


    }

}