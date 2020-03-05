<?php


namespace Nemundo\Process\Search\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Search\Install\SearchIndexClean;

class SearchIndexReindexingScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'search-reindex';
    }


    public function run()
    {

        (new SearchIndexClean())->cleanData();


        $reader = new ContentReader();
        $reader->model->loadContentType();
        foreach ($reader->getData() as $contentRow) {

            $contentType = $contentRow->getContentType();
            $contentType->saveSearchIndex();

        }

    }

}