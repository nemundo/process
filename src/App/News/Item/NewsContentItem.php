<?php


namespace Nemundo\Process\App\News\Item;


use Nemundo\Process\App\News\Data\News\News;
use Nemundo\Process\App\News\Type\NewsContentType;
use Nemundo\Process\Item\AbstractContentItem;

class NewsContentItem extends AbstractContentItem
{

    public $title;

    public $teaser;

    public function saveItem()
    {
        // TODO: Implement saveItem() method.

        $this->contentType=new NewsContentType();

        $data = new News();
        $data->updateOnDuplicate=true;
        $data->id = $this->dataId;
        $data->title=$this->title;
        $data->teaser=$this->teaser;
        $data->save();

        $this->saveContent();


    }

}