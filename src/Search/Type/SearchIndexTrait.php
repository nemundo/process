<?php


namespace Nemundo\Process\Search\Type;


use Nemundo\Process\Search\Data\SearchContent\SearchContent;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexDelete;
use Nemundo\Process\Search\Index\SearchIndexBuilder;

trait SearchIndexTrait
{

    abstract public function getText();

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


    /*
    protected function saveSearchContent($text='') {


        $data=new SearchContent();
        $data->updateOnDuplicate=true;
        $data->contentId=$this->getContentId();
        $data->title= $this->getSubject();
        $data->text=$text;
        $data->save();



    }*/




    protected function onIndex()
    {

    }


    protected function saveSearchIndex()
    {

        $this->onDataRow();
        //$this->onIndex();

        if ($this->searchIndex !== null) {
            $this->searchIndex->saveSearchIndex();
        }
    }

    protected function deleteSearchIndex()
    {

        $delete = new SearchIndexDelete();
        $delete->filter->andEqual($delete->model->contentId, $this->getContentId());
        $delete->delete();

    }


}