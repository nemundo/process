<?php


namespace Nemundo\Process\Workflow\Content\Status;

use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Workflow\Content\Form\StatusForm;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Content\Writer\ProcessStatusWriter;
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

        $contentRow = (new ContentReader())->getRowById($this->parentId);

        $this->saveContent();
        $this->saveTree();

        if ($this->changeStatus) {

            $update = new WorkflowUpdate();
            $update->statusId = $this->typeId;
            $update->updateById($contentRow->dataId);
        }

        if ($this->closeWorkflow) {
            $update = new WorkflowUpdate();
            $update->workflowClosed = true;
            $update->updateById($contentRow->dataId);
        }

        $this->saveSearchIndex();
        $this->onFinished();

        return $this->dataId;

    }





}