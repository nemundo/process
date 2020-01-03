<?php


namespace Nemundo\Process\Workflow\Content\Form;


use Nemundo\Process\Workflow\Content\Writer\ProcessStatusWriter;
use Nemundo\Process\Workflow\Parameter\WorkflowParameter;
use Nemundo\ToDo\Data\ToDo\ToDoUpdate;
use Nemundo\ToDo\Workflow\Status\DoneProcessStatus;

// ProcessStatusForm
class StatusForm extends AbstractStatusForm
{

    protected function onSubmit()
    {

        //$this->saveWorkflowLog();

        $writer=new ProcessStatusWriter();
        $writer->contentType=$this->contentType;
        $writer->parentId=$this->parentId;
        $writer->write();


        $this->redirectSite->addParameter(new WorkflowParameter($this->parentId));

    }

}