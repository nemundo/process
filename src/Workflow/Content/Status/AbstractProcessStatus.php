<?php


namespace Nemundo\Process\Workflow\Content\Status;

use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Workflow\Content\Form\StatusForm;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowUpdate;

// AbstractWorkflowStatus
abstract class AbstractProcessStatus extends AbstractSequenceContentType
{

    use ProcessStatusTrait;

    public function __construct($dataId = null)
    {
        $this->formClass = StatusForm::class;
        parent::__construct($dataId);
    }


    public function saveType()
    {

        $workflowId = $this->getParentProcess()->getWorkflowId();

        //$contentRow = (new ContentReader())->getRowById($this->parentId);

        $this->saveContent();
        $this->saveTree();

        if ($this->changeStatus) {

            $update = new WorkflowUpdate();
            $update->statusId = $this->typeId;
            $update->updateById($workflowId);
        }

        if ($this->closeWorkflow) {
            $update = new WorkflowUpdate();
            $update->workflowClosed = true;
            $update->updateById($workflowId);
        }

        $this->saveSearchIndex();
        $this->onFinished();

        return $this->dataId;

    }

}