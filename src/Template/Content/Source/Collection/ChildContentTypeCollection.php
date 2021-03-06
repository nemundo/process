<?php


namespace Nemundo\Process\Template\Content\Source\Collection;


use Nemundo\Process\Content\Collection\AbstractContentTypeCollection;
use Schleuniger\App\Aufgabe\Content\Process\AufgabeProcess;
use Schleuniger\App\ChangeRequest\Workflow\Process\EcoProcess;
use Schleuniger\App\ChangeRequest\Workflow\Process\EcrProcess;
use Schleuniger\App\Verbesserung\Workflow\Process\VerbesserungProcess;

class ChildContentTypeCollection extends AbstractContentTypeCollection
{

    protected function loadCollection()
    {

        $this->addContentType(new VerbesserungProcess());
        $this->addContentType(new AufgabeProcess());
        $this->addContentType(new EcrProcess());
        $this->addContentType(new EcoProcess());

    }

}