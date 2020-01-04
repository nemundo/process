<?php


namespace Nemundo\Process\Workflow\Content\Process;


class WorkflowProcess extends AbstractProcess
{

    protected function loadContentType()
    {
        // TODO: Implement loadContentType() method.
    }


    public function getProcess() {

        $workflowRow = $this->getWorkflowRow();

        /** @var AbstractProcess $process */
        $process= $workflowRow->process->getContentType($this->dataId);

        return $process;

    }

}