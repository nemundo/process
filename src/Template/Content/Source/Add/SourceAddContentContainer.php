<?php


namespace Nemundo\Process\Template\Content\Source\Add;


use Nemundo\Process\Template\Content\Source\Collection\SourceContentTypeCollection;


class SourceAddContentContainer extends AbstractAddContentContainer
{

    public function getContent()
    {

        $this->listboxLabel = 'Quelle';
        $this->contentTypeCollection = new SourceContentTypeCollection();

        return parent::getContent();

    }

}