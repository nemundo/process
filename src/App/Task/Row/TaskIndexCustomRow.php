<?php


namespace Nemundo\Process\App\Task\Row;


use Nemundo\Html\Container\AbstractContainer;
use Nemundo\Package\FontAwesome\Icon\CheckIcon;
use Nemundo\Process\App\Task\Data\TaskIndex\TaskIndexRow;
use Nemundo\Process\Group\Com\Span\GroupSpan;
use Nemundo\Workflow\Com\TrafficLight\DateTrafficLight;

class TaskIndexCustomRow extends TaskIndexRow
{


    public function getDeadline()
    {


        $deadline = '';
        if ($this->deadline !== null) {
            $deadline = $this->deadline->getShortDateLeadingZeroFormat();
        }


        return $deadline;

    }


    public function getTrafficLight(AbstractContainer $parentContainer)
    {


        if ($this->closed) {
            new CheckIcon($parentContainer);
        } else {

            $trafficLight = new DateTrafficLight($parentContainer);
            $trafficLight->date = $this->deadline;
        }


    }


    public function getAssignmentSpan(AbstractContainer $parentContainer)
    {

        $span = new GroupSpan($parentContainer);
        $span->groupId = $this->assignmentId;
        $span->content = $this->assignment->group;

    }


    public function getSourceList()
    {


    }

    public function getCreator()
    {

        $ersteller = $this->user->login . ' ' . $this->dateTime->getShortDateLeadingZeroFormat();
        return $ersteller;

    }

}