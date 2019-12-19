<?php


namespace Nemundo\Process\Workflow\Content\Form;


use Nemundo\Core\Log\LogMessage;
use Nemundo\Process\Workflow\Content\Item\Status\StatusItem;

trait StatusFormTrait
{

    protected function saveWorkflowLog()
    {

        // check content type
        if ($this->contentType == null) {
            (new LogMessage())->writeError('No Content type. '.$this->getClassName());
        }

        $workflowBuilder = new StatusItem();
        $workflowBuilder->contentType = $this->contentType;
        $workflowBuilder->parentId = $this->parentId;
        $workflowBuilder->dataId = $this->dataId;
        $workflowBuilder->saveItem();

    }

}