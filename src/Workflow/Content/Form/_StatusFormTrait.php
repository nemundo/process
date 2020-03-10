<?php


namespace Nemundo\Process\Workflow\Content\Form;


use Nemundo\Core\Log\LogMessage;
use Nemundo\Process\Workflow\Content\Item\Status\StatusItem;
use Nemundo\Process\Workflow\Content\Writer\ProcessStatusWriter;

trait StatusFormTrait
{

    protected function saveWorkflowLog()
    {

        // check content type
        if ($this->contentType == null) {
            (new LogMessage())->writeError('No Content type. '.$this->getClassName());
        }


        $writer = new ProcessStatusWriter();
        $writer->contentType = $this->contentType;
        $writer->parentId = $this->parentId;
        $writer->dataId = $this->dataId;
        $writer->write();

        /*
        $workflowBuilder = new StatusItem();
        $workflowBuilder->contentType = $this->contentType;
        $workflowBuilder->parentId = $this->parentId;
        $workflowBuilder->dataId = $this->dataId;
        $workflowBuilder->saveItem();*/

    }

}