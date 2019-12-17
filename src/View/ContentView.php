<?php


namespace Nemundo\Process\View;


use Nemundo\Html\Paragraph\Paragraph;

class ContentView extends AbstractContentView
{

    public function getContent()
    {


        $p = new Paragraph($this);
        $p->content=$this->contentType->getSubject($this->dataId);



        return parent::getContent(); // TODO: Change the autogenerated stub
    }


}