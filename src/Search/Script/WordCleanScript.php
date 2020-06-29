<?php


namespace Nemundo\Process\Search\Script;


use Nemundo\App\Script\Type\AbstractConsoleScript;
use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexCount;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexDelete;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexReader;
use Nemundo\Process\Search\Data\Word\WordDelete;
use Nemundo\Process\Search\Data\Word\WordReader;
use Nemundo\Process\Search\Install\SearchIndexClean;

class WordCleanScript extends AbstractConsoleScript
{

    protected function loadScript()
    {
        $this->scriptName = 'search-word-clean';
    }


    public function run()
    {

        $wordReader=new WordReader();
        foreach ($wordReader->getData() as $wordRow) {

            $count = new SearchIndexCount();
            $count->filter->andEqual($count->model->wordId, $wordRow->id);
            if ($count->getCount() === 0) {

                (new Debug())->write($wordRow->word);
                (new WordDelete())->deleteById($wordRow->id);

            }


        }



        //(new SearchIndexClean())->cleanData();

        /*
        $searchIndexReader = new SearchIndexReader();
        $searchIndexReader->filter->andEqual($searchIndexReader->model->contentId, $this->getContentId());
        foreach ($searchIndexReader->getData() as $searchIndexRow) {

            $count = new SearchIndexCount();
            $count->filter->andEqual($count->model->wordId, $searchIndexRow->wordId);
            $count->filter->andNotEqual($searchIndexReader->model->contentId, $this->getContentId());
            if ($count->getCount() === 0) {
                (new WordDelete())->deleteById($searchIndexRow->wordId);
            }

        }

        $delete = new SearchIndexDelete();
        $delete->filter->andEqual($delete->model->contentId, $this->getContentId());
        $delete->delete();*/


    }

}