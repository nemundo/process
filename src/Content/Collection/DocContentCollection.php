<?php


namespace Nemundo\Process\Content\Collection;


use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\Content\Type\AbstractContentTypeCollection;
use Nemundo\Srf\Content\Livestream\SrfLivestreamContentType;
use Nemundo\SwissPost\Content\PolitischeGemeindeContentType;

class DocContentCollection extends AbstractContentTypeCollection
{


    protected function loadCollection()
    {
     $this->addContentType(new WikiPageContentType());
     $this->addContentType(new PolitischeGemeindeContentType());
     $this->addContentType(new SrfLivestreamContentType());
        // TODO: Implement loadCollection() method.
    }

}