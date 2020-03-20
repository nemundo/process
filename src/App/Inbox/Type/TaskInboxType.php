<?php


namespace Nemundo\Process\App\Inbox\Type;


use Nemundo\Process\App\Task\Com\Container\TaskContainer;

class TaskInboxType extends AbstractInboxType
{

    protected function loadType()
    {

        $this->id='task';
        $this->title='Task';
        $this->containerClass=TaskContainer::class;

        // TODO: Implement loadType() method.
    }

}