<?php


namespace Nemundo\Process\Workflow\Content\Process;


use Nemundo\Core\Debug\Debug;

class WorkflowProcess extends AbstractProcess
{

    protected function loadContentType()
    {
        // TODO: Implement loadContentType() method.
    }


    public function getProcess() {

        $workflowRow = $this->getWorkflowRow();

        //(new Debug())->write($workflowRow->getSubject());

        /** @var AbstractProcess $process */
        $process= $workflowRow->process->getContentType($this->dataId);

        return $process;

    }

}