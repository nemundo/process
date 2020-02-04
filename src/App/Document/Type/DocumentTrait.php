<?php


namespace Nemundo\Process\App\Document\Type;


use Nemundo\Process\App\Document\Data\Document\Document;

trait DocumentTrait
{


    protected function saveDocument($text='') {

        $data = new Document();
        $data->sourceId = $this->getParentId();
        $data->contentId=$this->getContentId();
        $data->title= $this->getSubject();
        $data->text =$text; // $row->largeText;
        $data->save();


    }

}