<?php


namespace Nemundo\Process\Search\Type;


use Nemundo\Process\Search\Data\SearchIndex\SearchIndexCount;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexDelete;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexReader;
use Nemundo\Process\Search\Data\Word\WordDelete;
use Nemundo\Process\Search\Index\SearchIndexBuilder;

trait SearchIndexTrait
{

    abstract public function getText();

    abstract protected function isActive();

    /**
     * @var SearchIndexBuilder
     */
    private $searchIndex;

    protected function addSearchWord($word)
    {

        $this->addSearchText($word);
        $this->searchIndex->addWord($word);

    }


    protected function addSearchText($text)
    {

        if ($this->searchIndex == null) {
            $this->searchIndex = new SearchIndexBuilder($this->getContentId());
            $this->searchIndex->contentType = $this;
        }

        $this->searchIndex->addText($text);

    }


    protected function saveSearchIndex()
    {

        if ($this->isActive()) {

            $this->onDataRow();

            if ($this->searchIndex !== null) {
                $this->searchIndex->saveSearchIndex();
            }

        } else {

            $this->deleteSearchIndex();

        }

    }


    protected function deleteSearchIndex()
    {

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
        $delete->delete();

    }

}