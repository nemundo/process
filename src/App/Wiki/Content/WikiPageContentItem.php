<?php


namespace Nemundo\Process\App\Wiki\Content;


use Nemundo\Process\App\Wiki\Data\Wiki\Wiki;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Search\Index\SearchIndexBuilder;

class WikiPageContentItem extends AbstractContentItem
{

    public $title;

    public function saveItem()
    {

        $this->contentType = new WikiPageContentType();

        $data = new Wiki();
        $data->id = $this->dataId;
        $data->title = $this->title;
        $data->save();

        $this->saveContent();

        $search = new SearchIndexBuilder($this->dataId);
        $search->addText($this->title);
        $search->saveIndex();


    }

}