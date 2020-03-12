<?php


namespace Nemundo\Process\App\Document\Index;


use Nemundo\Process\App\Document\Data\Document\Document;
use Nemundo\Process\App\Document\Data\Document\DocumentDelete;


trait DocumentIndexTrait
{

    // auflistung unter new
    public $showNewButton=true;


    abstract protected function isClosed();

    protected function saveDocumentIndex()
    {

        $data = new Document();
        $data->updateOnDuplicate = true;
        $data->documentTypeId = $this->typeId;
        $data->contentId = $this->getContentId();
        $data->title = $this->getSubject();
        $data->closed = $this->isClosed();
        $data->save();

    }


    protected function deleteDocumentIndex()
    {

        $delete = new DocumentDelete();
        $delete->filter->andEqual($delete->model->contentId, $this->getContentId());
        $delete->delete();

    }


}