<?php


namespace Nemundo\Process\App\Inbox\Type;


use Nemundo\Process\App\Calendar\Com\Container\CalendarContainer;
use Nemundo\Process\App\Task\Com\Container\TaskContainer;

class CalendarInboxType extends AbstractInboxType
{

    protected function loadType()
    {

        $this->id='calendar';
        $this->title='Calendar';
        $this->containerClass=CalendarContainer::class;

        // TODO: Implement loadType() method.
    }

}