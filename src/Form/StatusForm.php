<?php


namespace Nemundo\Process\Form;


use Nemundo\Process\Parameter\WorkflowParameter;

class StatusForm extends AbstractStatusForm
{

    protected function onSubmit()
    {

        $this->saveWorkflowLog();


        $this->redirectSite->addParameter(new WorkflowParameter($this->workflowId));


        // TODO: Implement onSubmit() method.
    }

}