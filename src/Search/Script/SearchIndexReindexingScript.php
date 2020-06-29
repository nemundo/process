<?php


namespace Nemundo\Process\Search\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Search\Install\SearchIndexClean;
use Nemundo\Process\Search\Type\SearchIndexTrait;

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
            //(new Debug())->write($contentType->getSubject());

            //if ($contentType->isObjectOfTrait(SearchIndexTrait::class)) {
                $contentType->saveIndex();
            //}

        }

    }

}