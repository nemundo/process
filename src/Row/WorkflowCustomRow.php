<?php

namespace Nemundo\Process\Row;



// Nemundo\Process\Row\WorkflowCustomRow

use Nemundo\Process\Data\Workflow\WorkflowRow;

class WorkflowCustomRow extends WorkflowRow
{

    public function getSubject()
    {

        $subject = $this->workflowNumber . ' ' . $this->subject;
        return $subject;

    }


    public function getViewSite() {


        $site = null;


        //$process = $this->process->getProcess();
        //$site = $process->getViewSite($this->)


        /*switch ($this->processId) {

            case (new EcrProcess())->id:

                $ecrId = (new WorkflowBuilder($this->id))->getEcrId();
                $site = (new EcrProcess())->getViewSite($ecrId);

                break;

            case (new EcoProcess())->id:

                $ecoId = (new WorkflowBuilder($this->id))->getEcoId();
                $site = (new EcoProcess())->getViewSite($ecoId);

                break;

        }*/

        return $site;

    }


}