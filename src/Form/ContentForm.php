<?php


namespace Nemundo\Process\Form;


use Nemundo\Process\Item\ContentItem;

class ContentForm extends AbstractContentForm
{

    protected function onSubmit()
    {

        $item = new ContentItem($this->dataId);
        $item->contentType=$this->contentType;
        $item->dataId=$this->dataId;
        $item->parentId=$this->parentId;
        $item->saveItem();


        // TODO: Implement onSubmit() method.
    }

}