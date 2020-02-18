<?php


namespace Nemundo\Process\Workflow\Row;


use Nemundo\Html\Container\AbstractContainer;
use Nemundo\Package\FontAwesome\Icon\CheckIcon;
use Nemundo\Workflow\Com\TrafficLight\DateTrafficLight;

trait WorkflowCustomRowTrait
{

    public function getSubject()
    {

        $subject = $this->workflowNumber . ' ' . $this->subject;
        return $subject;

    }

    public function getCreator()
    {


        $creator = $this->user->login . ' ' . $this->dateTime->getShortDateLeadingZeroFormat();
        return $creator;

    }


    public function getDeadline() {


        $deadline = '';
        if ($this->deadline !==null) {
            $deadline=   $this->deadline->getShortDateLeadingZeroFormat();
        }


        return $deadline;

    }


    public function getTrafficLight(AbstractContainer $parentContainer)
    {


        if ($this->workflowClosed) {
            new CheckIcon($parentContainer);
        } else {

            $trafficLight = new DateTrafficLight($parentContainer);
            $trafficLight->date = $this->deadline;
        }


    }



    public function getLeaptimeText() {

    }


}