<?php


namespace Nemundo\Process\Content\Form;


use Nemundo\Html\Paragraph\Paragraph;

class ContentForm extends AbstractContentForm
{


    public function getContent()
    {

        $p = new Paragraph($this);
        $p->content = 'Content Form';

        return parent::getContent(); // TODO: Change the autogenerated stub
    }


    protected function onSubmit()
    {

        /*
        $item = new ContentItem($this->dataId);
        $item->contentType = $this->contentType;
        $item->dataId = $this->dataId;
        $item->parentId = $this->parentId;
        $item->saveItem();*/

    }

}