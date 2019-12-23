<?php

namespace Nemundo\Process\Search\Index;


use Nemundo\App\Search\Model\DocumentModel;
use Nemundo\App\Search\Model\IndexModel;
use Nemundo\App\Search\Model\WordModel;
use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Text\KeywordList;
use Nemundo\Model\Count\ModelDataCount;
use Nemundo\Model\Delete\ModelDelete;
use Nemundo\Model\Id\ModelId;
use Nemundo\Model\Reader\ModelDataReader;
use Nemundo\Process\Content\Data\Content\ContentId;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexBulk;
use Nemundo\Process\Search\Data\Word\WordBulk;


class SearchIndexBuilder extends AbstractBase
{


    /**
     * @var string
     */
    public $dataId;

    private $wordList = [];
    private $indexList = [];


    public function __construct($dataId=null)
    {

        if ($dataId!==null) {
        $this->dataId=$dataId;
        }

    }


    //abstract protected function loadBuilder();


    public function addText($text, $relevance = 0)
    {

        // Umlaute umwandeln ü -> u ???

        // &nbsp;
        // Hyperlink
        // Doppel s


        $keywordList = new KeywordList();
        $keywordList->hashAsId = true;
        $keywordList->lowerCase = false;
        $keywordList->addInputText = false;
        foreach ($keywordList->getKeywordList($text) as $keywordId => $keyword) {
            $this->addWord($keyword, $relevance);
        }

    }


    public function addWord($word, $relevance = 0)
    {

        // dataId Check

        //(new Debug())->write($word);

        if (($word !== '') && ($word !== null)) {

            $wordId = md5(mb_strtolower($word));

            //foreach ($this->searchEngineList as $searchEngine) {

            $this->wordList[$wordId] = $word;
            $this->indexList[$wordId] = $relevance;

            // Sum of Relevance


        }


    }


    public function saveIndex()
    {



        // delete existing



        /*
$id = new ContentId();
$id->filter->andEqual($id->model->dataId,$this->dataId);
$contentId=$id->getId();
*/

        $data = new WordBulk();
        foreach ($this->wordList as $wordId => $word) {
            $data->ignoreIfExists = true;
            $data->id = $wordId;
            $data->word = $word;
            $data->save();
        }
        $data->saveBulk();

        $data = new SearchIndexBulk();
        foreach ($this->indexList as $wordId => $relevance) {

            //$data->updateOnDuplicate = true;
            $data->ignoreIfExists = true;
            $data->contentId = $this->dataId;
            $data->wordId = $wordId;
            //$data->typeValueList->setModelValue($indexModel->relevance, $relevance);
            $data->save();

        }

        $data->saveBulk();


    }


    public function removeFromIndex()
    {


        if ($this->dataId == null) {
            (new LogMessage())->writeError('No Data Id');
            exit;
        }

        foreach ($this->searchEngineList as $searchEngine) {

            $indexModel = new IndexModel($searchEngine);
            $wordModel = new WordModel($searchEngine);
            $documentModel = new DocumentModel($searchEngine);


            $dataIdTmp = $this->dataId;
            if ($searchEngine->sourceMode) {

                $id = new ModelId();
                $id->model = $documentModel;
                $id->filter->andEqual($id->model->dataId, $this->dataId);
                $dataIdTmp = $id->getId();

            }


            $indexReader = new ModelDataReader();
            $indexReader->model = $indexModel;
            $indexReader->filter->andEqual($indexReader->model->dataId, $dataIdTmp);  // $this->dataId);
            foreach ($indexReader->getData() as $indexRow) {

                $wordId = $indexRow->getModelValue($indexModel->wordId);

                $wordCount = new ModelDataCount();
                $wordCount->model = $indexModel;
                $wordCount->filter->andEqual($wordCount->model->wordId, $wordId);
                $wordCount->filter->andNotEqual($wordCount->model->dataId, $dataIdTmp);  // $this->dataId);
                if ($wordCount->getCount() == 0) {
                    $wordDelete = new ModelDelete();
                    $wordDelete->model = $wordModel;
                    $wordDelete->deleteById($wordId);
                }

            }

            $indexDelete = new ModelDelete();
            $indexDelete->model = $indexModel;
            $indexDelete->filter->andEqual($indexDelete->model->dataId, $dataIdTmp);  // $this->dataId);
            $indexDelete->delete();


            if ($searchEngine->sourceMode) {

                $delete = new ModelDelete();
                $delete->model = $documentModel;
                $delete->filter->andEqual($delete->model->sourceId, $this->searchSource->sourceId);
                $delete->filter->andEqual($delete->model->dataId, $this->dataId);
                $delete->delete();

            }


        }

    }

}