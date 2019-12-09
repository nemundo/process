<?php


namespace Nemundo\Process\Form;


use Nemundo\Process\Parameter\WorkflowParameter;

class StatusForm extends AbstractStatusForm
{

    protected function onSave()
    {

        $this->saveWorkflowLog();


        $this->redirectSite->addParameter(new WorkflowParameter($this->workflowId));


        // TODO: Implement onSubmit() method.
    }

}