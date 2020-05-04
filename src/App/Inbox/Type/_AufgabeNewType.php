<?php


namespace Nemundo\Process\App\Inbox\Type;


class AufgabeNewType extends AbstractInboxType
{

    protected function loadType()
    {


        $this->title='Neue Aufgabe';
        $this->id='aufgabe-new';
        //$this->containerClass=AufgabeNewContainer::class;

        // TODO: Implement loadType() method.
    }

}