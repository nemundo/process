<?php


namespace Nemundo\Process\Content\View;


use Nemundo\Html\Paragraph\Paragraph;

class ContentView extends AbstractContentView
{

    public function getContent()
    {

        //$item = $this->contentType->getItem($this->dataId);

        //$type = new ContentTy

        $p = new Paragraph($this);
        //$p->content= $item->getSubject();
        

//        $p = new Paragraph($this);
//        $p->content=$this->contentType->getSubject($this->dataId);

        return parent::getContent(); // TODO: Change the autogenerated stub

    }


}