<?php


namespace Nemundo\Process\Template\Content\Source\Add;


use Nemundo\Process\Template\Content\Source\Collection\ChildContentTypeCollection;

class ChildAddContentContainer extends AbstractAddContentContainer
{

    public function getContent()
    {

        $this->listboxLabel = 'Aufgabe';
        $this->contentTypeCollection=new ChildContentTypeCollection();

        return parent::getContent();

    }

}