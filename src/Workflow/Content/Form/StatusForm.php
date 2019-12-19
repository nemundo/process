<?php


namespace Nemundo\Process\Workflow\Content\Form;


use Nemundo\Process\Workflow\Parameter\WorkflowParameter;
use Nemundo\ToDo\Data\ToDo\ToDoUpdate;
use Nemundo\ToDo\Workflow\Status\DoneProcessStatus;

// ProcessStatusForm
class StatusForm extends AbstractStatusForm
{

    protected function onSubmit()
    {

        $this->saveWorkflowLog();
        $this->redirectSite->addParameter(new WorkflowParameter($this->parentId));

    }

}