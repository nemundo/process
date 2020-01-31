<?php


namespace Nemundo\Process\Content\Com\ListBox;


use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;

class ContentTypeListBox extends BootstrapListBox
{


    protected function loadContainer()
    {

        $this->label = 'Content Type';
        $this->name = (new ContentTypeParameter())->parameterName;

        $reader = new ContentTypeReader();
        $reader->addOrder($reader->model->contentType);
        foreach ($reader->getData() as $contentTypeRow) {
            $this->addItem($contentTypeRow->id, $contentTypeRow->contentType);
        }

    }

}