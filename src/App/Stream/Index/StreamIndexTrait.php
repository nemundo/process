<?php


namespace Nemundo\Process\App\Stream\Index;


use Nemundo\Process\App\Stream\Data\Stream\Stream;

trait StreamIndexTrait
{


    public function saveStreamIndex() {


        $data=new Stream();
        $data->contentId=$this->getContentId();
        $data->save();


    }

}