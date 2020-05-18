<?php

namespace Nemundo\Process\Search\Index;


use Nemundo\App\Search\Model\DocumentModel;
use Nemundo\App\Search\Model\IndexModel;
use Nemundo\App\Search\Model\WordModel;
use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Text\KeywordList;
use Nemundo\Core\Type\Text\Text;
use Nemundo\Model\Count\ModelDataCount;
use Nemundo\Model\Delete\ModelDelete;
use Nemundo\Model\Id\ModelId;
use Nemundo\Model\Reader\ModelDataReader;
use Nemundo\Process\Content\Type\AbstractContentType;

use Nemundo\Process\Search\Data\SearchIndex\SearchIndexBulk;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexDelete;
use Nemundo\Process\Search\Data\Word\WordBulk;
use Nemundo\Process\Search\Data\WordContentType\WordContentTypeBulk;


class SearchIndexBuilder extends AbstractBase
{

    /**
     * @var AbstractContentType
     */
    public $contentType;

    /**
     * @var string
     */
    public $contentId;

    private $wordList = [];
    private $indexList = [];


    public function __construct($contentId = null)
    {

        if ($contentId !== null) {
            $this->contentId = $contentId;
        }

    }


    public function addText($text, $relevance = 0)
    {

        // Umlaute umwandeln ü -> u ???

        // &nbsp;
        // Hyperlink
        // Doppel s

        $text = (new Text($text))->removeHtmlTags()->getValue();

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

        if (($word !== '') && ($word !== null)) {

            // crc32 statt md5 ???
            $wordId = md5(mb_strtolower($word));

            $this->wordList[$wordId] = $word;
            $this->indexList[$wordId] = $relevance;

            // Sum of Relevance


        }


    }


    public function saveSearchIndex()
    {

        $delete = new SearchIndexDelete();
        $delete->filter->andEqual($delete->model->contentId, $this->contentId);
        $delete->delete();

        $data = new WordBulk();
        foreach ($this->wordList as $wordId => $word) {
            $data->ignoreIfExists = true;
            $data->id = $wordId;
            $data->word = $word;
            $data->save();
        }
        $data->saveBulk();


        $data = new WordContentTypeBulk();
        foreach ($this->wordList as $wordId => $word) {
            $data->ignoreIfExists = true;
            $data->id = $wordId;
            $data->contentTypeId=$this->contentType->typeId;
            $data->word = $word;
            $data->save();
        }
        $data->saveBulk();


        $data = new SearchIndexBulk();
        foreach ($this->indexList as $wordId => $relevance) {

            $data->ignoreIfExists = true;
            $data->contentId = $this->contentId;
            $data->wordId = $wordId;
            $data->contentTypeId = $this->contentType->typeId;
            $data->save();

        }

        $data->saveBulk();


    }


    public function removeFromIndex()
    {


        if ($this->contentId == null) {
            (new LogMessage())->writeError('No Data Id');
            exit;
        }

        foreach ($this->searchEngineList as $searchEngine) {

            $indexModel = new IndexModel($searchEngine);
            $wordModel = new WordModel($searchEngine);
            $documentModel = new DocumentModel($searchEngine);


            $dataIdTmp = $this->contentId;
            if ($searchEngine->sourceMode) {

                $id = new ModelId();
                $id->model = $documentModel;
                $id->filter->andEqual($id->model->dataId, $this->contentId);
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
                $delete->filter->andEqual($delete->model->dataId, $this->contentId);
                $delete->delete();

            }


        }

    }

}