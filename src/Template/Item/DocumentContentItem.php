<?php


namespace Nemundo\Process\Template\Item;


use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Template\Data\Document\Document;
use Nemundo\Process\Template\Type\DocumentContentType;

// DocumentTemplateContentItem
class DocumentContentItem extends AbstractContentItem
{

    /**
     * @var FileRequest
     */
    public $fileRequest;


    protected function saveData()
    {

        $this->contentType = new DocumentContentType();

        $data = new Document();
        $data->id = $this->dataId;
        $data->active = true;
        $data->document->fromFileRequest($this->fileRequest);
        $data->save();

        //$this->saveContent();

    }

}