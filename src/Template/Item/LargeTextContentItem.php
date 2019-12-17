<?php


namespace Nemundo\Process\Template\Item;


use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Type\LargeTextContentType;

class LargeTextContentItem extends AbstractContentItem
{

    public $largeText;

    public function saveItem()
    {

        $this->contentType = new LargeTextContentType();

        $data = new LargeText();
        $data->updateOnDuplicate=true;
        $data->id = $this->dataId;
        $data->largeText = $this->largeText;
        $data->save();

        $this->saveContent();

    }

}