<?php


namespace Nemundo\Process\Template\Item;


use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Process\Builder\AbstractStatusLogBuilder;
use Nemundo\Process\Item\AbstractContentItem;
use Nemundo\Process\Template\Data\Document\Document;
use Nemundo\Process\Template\Status\DocumentStatus;
use Nemundo\Process\Template\Type\DocumentContentType;

class DocumentContentItem extends AbstractContentItem
{

    /**
     * @var FileRequest
     */
    public $fileRequest;

    public function saveItem()
    {

        $this->contentType =new DocumentContentType();

        $data = new Document();
        $data->id=$this->dataId;
        $data->active=true;
        $data->document->fromFileRequest($this->fileRequest);
        //$data->workflowId = $this->workflowId;
       $data->save();

       $this->saveContent();

        //$this->saveWorkflowLog();

    }

}