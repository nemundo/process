<?php


namespace Nemundo\Process\Workflow\Content\Writer;


use Nemundo\Process\Content\Writer\TreeContentWriter;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;

// WorkflowStatusWriter
class ProcessStatusWriter extends TreeContentWriter
{

    /**
     * @var AbstractProcessStatus
     */
    public $contentType;

    public function write()
    {

        parent::write();

        if ($this->contentType->changeStatus) {

            $update = new WorkflowUpdate();
            $update->statusId = $this->contentType->contentId;
            $update->updateById($this->parentId);
        }

        if ($this->contentType->closeWorkflow) {
            $update = new WorkflowUpdate();
            $update->workflowClosed = true;
            $update->updateById($this->parentId);
        }


    }

}