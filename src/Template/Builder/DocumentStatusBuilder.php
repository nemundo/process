<?php


namespace Nemundo\Process\Template\Builder;


use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Process\Builder\AbstractStatusLogBuilder;
use Nemundo\Process\Template\Data\Document\Document;
use Nemundo\Process\Template\Status\DocumentStatus;

class DocumentStatusBuilder extends AbstractStatusLogBuilder
{

    /**
     * @var FileRequest
     */
    public $fileRequest;

    public function saveStatus()
    {

        $this->contentType=new DocumentStatus();

        $data = new Document();
        $data->active=true;
        $data->document->fromFileRequest($this->fileRequest);
        $data->workflowId = $this->parentId;
        $this->dataId=  $data->save();

        $this->saveWorkflowLog();

    }

}