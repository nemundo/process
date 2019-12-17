<?php


namespace Nemundo\Process\Item;


class ContentItem extends AbstractContentItem
{

    public function saveItem()
    {
        $this->saveContent();
    }

}