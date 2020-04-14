<?php


namespace Nemundo\Process\Template\Content\Source\Collection;


use Nemundo\Process\Content\Collection\AbstractContentTypeCollection;
use Schleuniger\App\Aufgabe\Content\Process\AufgabeProcess;
use Schleuniger\App\Aufgabenliste\Content\AufgabenlisteContentType;
use Schleuniger\App\ChangeRequest\Workflow\Process\EcoProcess;
use Schleuniger\App\ChangeRequest\Workflow\Process\EcrProcess;
use Schleuniger\App\Projekt\Content\Projekt\ProjektContentType;
use Schleuniger\App\Verbesserung\Workflow\Process\VerbesserungProcess;

class SourceContentTypeCollection extends AbstractContentTypeCollection
{

    protected function loadCollection()
    {

        $this->addContentType(new VerbesserungProcess());
        $this->addContentType(new AufgabeProcess());
        $this->addContentType(new EcrProcess());
        $this->addContentType(new EcoProcess());
        $this->addContentType(new ProjektContentType());
        $this->addContentType(new AufgabenlisteContentType());
        //$this->addContentType(new SitzungContentType());

    }

}