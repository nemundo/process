<?php


namespace Nemundo\Process\Content\Form;


use Nemundo\Process\Content\Item\ContentItem;

class ContentForm extends AbstractContentForm
{

    protected function onSubmit()
    {

        $item = new ContentItem($this->dataId);
        $item->contentType = $this->contentType;
        $item->dataId = $this->dataId;
        $item->parentId = $this->parentId;
        $item->saveItem();

    }

}