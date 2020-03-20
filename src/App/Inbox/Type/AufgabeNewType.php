<?php


namespace Nemundo\Process\App\Inbox\Type;


use Schleuniger\App\Aufgabe\Com\Container\AufgabeNewContainer;
use Schleuniger\App\Aufgabe\Content\Process\AufgabeProcess;

class AufgabeNewType extends AbstractInboxType
{

    protected function loadType()
    {


        $this->title='Neue Aufgabe';
        $this->id='aufgabe-new';
        $this->containerClass=AufgabeNewContainer::class;

        // TODO: Implement loadType() method.
    }

}