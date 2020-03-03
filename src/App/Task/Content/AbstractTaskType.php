<?php


namespace Nemundo\Process\App\Task\Content;


use Nemundo\Process\App\Task\Data\Task\Task;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

abstract class AbstractTaskType extends AbstractTreeContentType
{


    public $sourceId;

    public $task;

    public $assignmentId;

    public $deadline;


    /*
    abstract public function getSourceId();

    abstract public function getTask();

    abstract public function getAssignment();

    abstract public function getDeadline();*/

    protected function loadContentType()
    {

        $this->typeLabel='Task';
        // TODO: Implement loadContentType() method.
    }


    protected function onCreate()
    {
        parent::onCreate(); // TODO: Change the autogenerated stub


        $data = new Task();
        $data->sourceId=$this->sourceId;
        $data->task = $this->task;
        $data->assignmentId=$this->assignmentId;
        $data->deadline=$this->deadline;
        $data->save();


    }


}