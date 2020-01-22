<?php


namespace Nemundo\Process\Workflow\Content\Form;


use Nemundo\Process\Workflow\Content\Writer\ProcessStatusWriter;

// ProcessStatusForm
class StatusForm extends AbstractStatusForm
{

    protected function onSubmit()
    {

        $this->contentType->parentId = $this->parentId;
        $this->contentType->saveType();

        //$this->redirectSite->addParameter(new WorkflowParameter($this->parentId));

    }

}