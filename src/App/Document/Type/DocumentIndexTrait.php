<?php


namespace Nemundo\Process\App\Document\Type;


use Nemundo\Process\App\Document\Data\Document\Document;
use Nemundo\Process\App\Document\Data\Document\DocumentDelete;


trait DocumentIndexTrait
{


    protected function saveDocumentIndex() {

        $data = new Document();
        $data->updateOnDuplicate=true;
       // $data->sourceId = $this->getParentId();
        $data->contentId=$this->getContentId();
        $data->title= $this->getSubject();

       // $this->getText();

        //$data->text =$text; // $row->largeText;
        $data->save();


    }


    protected function deleteDocumentIndex() {


        $delete = new DocumentDelete();
        $delete->filter->andEqual($delete->model->contentId,$this->getContentId());
        $delete->delete();

    }


}