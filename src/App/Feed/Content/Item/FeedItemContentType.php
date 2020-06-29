<?php


namespace Nemundo\Process\App\Feed\Content\Item;


use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\App\Feed\Data\FeedItem\FeedItem;
use Nemundo\Process\App\Feed\Data\FeedItem\FeedItemCount;
use Nemundo\Process\App\Feed\Data\FeedItem\FeedItemDelete;
use Nemundo\Process\App\Feed\Data\FeedItem\FeedItemId;
use Nemundo\Process\App\Feed\Data\FeedItem\FeedItemReader;
use Nemundo\Process\App\Feed\Data\FeedItem\FeedItemRow;
use Nemundo\Process\App\Feed\Parameter\FeedItemParameter;
use Nemundo\Process\App\Feed\Site\FeedItemRedirectSite;
use Nemundo\Process\App\Stream\Index\StreamIndexTrait;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class FeedItemContentType extends AbstractTreeContentType
{

    use StreamIndexTrait;

    // stream index

    // Index/Geo
    // Index/Stream


    public $feedId;

    public $title;

    public $description;

    public $url;


    // get Feed Item als source in search (aufgabe auch nicht)

    protected function loadContentType()
    {

        $this->typeLabel = 'Feed Item';
        $this->typeId = '7c727c6f-e179-442d-acf6-e5f7c602d1ee';

        $this->viewClass = FeedItemContentView::class;
        $this->viewSite = FeedItemRedirectSite::$site;
        $this->parameterClass = FeedItemParameter::class;

    }


    protected function onCreate()
    {

        $data = new FeedItem();
        $data->feedId = $this->feedId;
        $data->title = $this->title;
        $data->description = $this->description;
        $data->url = $this->url;
        $data->dateTime = (new DateTime())->setNow();
        $this->dataId = $data->save();

    }


    protected function onUpdate()
    {

    }


    protected function onIndex()
    {

        $itemRow = $this->getDataRow();

        $this->addSearchText($itemRow->title);
        $this->addSearchText($itemRow->description);
        $this->saveSearchIndex();

        $this->saveStreamIndex();


    }


    protected function onDelete()
    {
        (new FeedItemDelete())->deleteById($this->dataId);
        $this->deleteSearchIndex();

    }


    public function existItem()
    {

        $value = true;

        $count = new FeedItemCount();
        $count->filter->andEqual($count->model->url, $this->url);
        if ($count->getCount() === 0) {
            $value = false;
        } else {

            $id = new FeedItemId();
            $id->filter->andEqual($id->model->url, $this->url);
            $this->dataId = $id->getId();

        }

        return $value;

    }


    protected function onDataRow()
    {
        $reader = new FeedItemReader();
        $reader->model->loadFeed();
        $this->dataRow = $reader->getRowById($this->dataId);
    }


    /**
     * @return \Nemundo\Model\Row\AbstractModelDataRow|FeedItemRow
     */
    public function getDataRow()
    {
        return parent::getDataRow();
    }


    public function getSubject()
    {
        return $this->getDataRow()->title;
    }


    public function getText()
    {
        return $this->getDataRow()->description;
    }

}