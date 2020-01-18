<?php

namespace Nemundo\Process\Workflow\Row;

use Nemundo\Html\Container\AbstractContainer;
use Nemundo\Package\FontAwesome\Icon\CheckIcon;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowRow;
use Nemundo\Workflow\Com\TrafficLight\DateTrafficLight;

class WorkflowCustomRow extends WorkflowRow
{

    public function getSubject()
    {

        $subject = $this->workflowNumber . ' ' . $this->subject;
        return $subject;

    }


    public function getCreator()
    {

        $creator = $this->user->displayName . ' ' . $this->dateTime->getShortDateTimeWithSecondLeadingZeroFormat();
        return $creator;


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


    public function getViewSite()
    {

        $process = $this->process->getContentType($this->id);
        $site = $process->getViewSite();
        //$site->title = $this->getSubject();

        return $site;

    }


    public function getProcess()
    {

        /** @var AbstractProcess $process */
        $process = $this->process->getContentType($this->id);

        return $process;

    }

}