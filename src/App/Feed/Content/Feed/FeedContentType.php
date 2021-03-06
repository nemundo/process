<?php


namespace Nemundo\Process\App\Feed\Content\Feed;


use Nemundo\Process\App\Feed\Data\Feed\Feed;
use Nemundo\Process\App\Feed\Data\Feed\FeedCount;
use Nemundo\Process\App\Feed\Data\Feed\FeedDelete;
use Nemundo\Process\App\Feed\Data\Feed\FeedId;
use Nemundo\Process\App\Feed\Data\Feed\FeedReader;
use Nemundo\Process\App\Feed\Data\Feed\FeedRow;
use Nemundo\Process\App\Feed\Data\Feed\FeedUpdate;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class FeedContentType extends AbstractTreeContentType
{

    public $feedUrl;

    public $title;

    public $description;

    protected function loadContentType()
    {

        $this->typeLabel = 'Rss Feed';
        $this->typeId = '93250a52-8f7d-4971-af46-467369ae5993';

        $this->formClass = FeedContentForm::class;
        $this->viewClass = FeedContentView::class;

    }


    protected function onCreate()
    {

        $data = new Feed();
        $data->ignoreIfExists = true;
        $data->feedUrl = $this->feedUrl;
        $this->dataId = $data->save();

    }


    protected function onUpdate()
    {

        if ($this->title !== null) {
            $update = new FeedUpdate();
            $update->title = $this->title;
            $update->updateById($this->dataId);
        }

    }


    protected function onIndex()
    {

        $feedRow = $this->getDataRow();

        $this->addSearchText($feedRow->title);
        $this->saveSearchIndex();

    }


    protected function onDelete()
    {

        (new FeedDelete())->deleteById($this->dataId);
        $this->deleteSearchIndex();

    }


    protected function onDataRow()
    {

        $this->dataRow = (new FeedReader())->getRowById($this->dataId);

    }


    public function existItem()
    {

        $value = null;

        $count = new FeedCount();
        $count->filter->andEqual($count->model->feedUrl, $this->feedUrl);
        if ($count->getCount() === 0) {
            $value = false;


        } else {

            $value = true;

            $id = new FeedId();
            $id->filter->andEqual($id->model->feedUrl, $this->feedUrl);
            $this->dataId = $id->getId();

        }

        return $value;

    }


    /**
     * @return \Nemundo\Model\Row\AbstractModelDataRow|FeedRow
     */
    public function getDataRow()
    {
        return parent::getDataRow(); // TODO: Change the autogenerated stub
    }


    public function getSubject()
    {
        return $this->getDataRow()->title;
    }


}