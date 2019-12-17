<?php


namespace Nemundo\Process\Form;


use Nemundo\Process\Workflow\Parameter\WorkflowParameter;

// ProcessStatusForm
class StatusForm extends AbstractStatusForm
{

    protected function onSubmit()
    {

        $this->saveWorkflowLog();
        $this->redirectSite->addParameter(new WorkflowParameter($this->parentId));


        // TODO: Implement onSubmit() method.
    }

}