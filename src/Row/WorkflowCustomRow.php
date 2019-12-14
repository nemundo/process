<?php

namespace Nemundo\Process\Row;

use Nemundo\Process\Data\Workflow\WorkflowRow;

class WorkflowCustomRow extends WorkflowRow
{

    public function getSubject()
    {

        $subject = $this->workflowNumber . ' ' . $this->subject;
        return $subject;

    }


    public function getViewSite()
    {

        $process = $this->process->getProcess();
        $site = $process->getViewSite($this->id);
        $site->title = $this->getSubject();

        return $site;

    }

}