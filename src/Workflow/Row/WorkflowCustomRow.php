<?php

namespace Nemundo\Process\Workflow\Row;

use Nemundo\Process\Workflow\Data\Workflow\WorkflowRow;

class WorkflowCustomRow extends WorkflowRow
{

    public function getSubject()
    {

        $subject = $this->workflowNumber . ' ' . $this->subject;
        return $subject;

    }


    public function getViewSite()
    {

        $process = $this->process->getContentType($this->id);
        $site = $process->getViewSite();
        //$site->title = $this->getSubject();

        return $site;

    }

}