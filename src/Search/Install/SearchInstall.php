<?php


namespace Nemundo\Process\Search\Install;


use Nemundo\App\Application\Setup\ApplicationSetup;
use Nemundo\App\Script\Setup\ScriptSetup;

use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Search\Application\SearchApplication;
use Nemundo\Process\Search\Content\Log\SearchLogContentType;
use Nemundo\Process\Search\Data\SearchCollection;
use Nemundo\Process\Search\Script\SearchCleanScript;
use Nemundo\Process\Search\Script\SearchIndexReindexingScript;
use Nemundo\Process\Search\Script\WordCleanScript;
use Nemundo\App\Application\Type\Install\AbstractInstall;

class SearchInstall extends AbstractInstall
{

    public function install()
    {

        (new ApplicationSetup())
            ->addApplication(new SearchApplication());


        $setup = new ModelCollectionSetup();
        $setup->addCollection(new SearchCollection());

        $setup=new ContentTypeSetup();
        $setup->addContentType(new SearchLogContentType());

        $setup=new ScriptSetup();
        $setup->addScript(new SearchIndexReindexingScript());
        $setup->addScript(new SearchCleanScript());

        (new ScriptSetup(new SearchApplication()))
            ->addScript(new WordCleanScript());

    }

}