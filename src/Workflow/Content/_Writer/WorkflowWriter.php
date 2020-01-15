<?php


namespace Nemundo\Process\Workflow\Content\Writer;


use Nemundo\Process\Content\Writer\TreeContentWriter;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Data\Workflow\Workflow;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowValue;
use Nemundo\Workflow\App\Identification\Model\Identification;

class WorkflowWriter extends TreeContentWriter
{

    /**
     * @var AbstractProcess
     */
    public $contentType;

    public $number;

    public $workflowNumber;

    public $workflowSubject;

    public $prefixNumber;

    public $startNumber;


    /**
     * @var Identification
     */
    public $assignment;




    public function write()
    {

        parent::write();

        $processId = $this->contentType->typeId;

        if ($this->number == null) {
            $value = new WorkflowValue();
            $value->field = $value->model->number;
            $value->filter->andEqual($value->model->processId, $processId);
            $this->number = $value->getMaxValue();
            if ($this->number == "") {
                $this->number = $this->startNumber;
            }
            $this->number = $this->number + 1;

            $this->workflowNumber = $this->prefixNumber . $this->number;
        }

        $data = new Workflow();
        $data->id = $this->dataId;
        $data->processId = $processId;
        $data->number = $this->number;
        $data->workflowNumber = $this->workflowNumber;
        $data->statusId = $this->contentType->startContentType->typeId;
        $data->subject = $this->workflowSubject;
        $data->assignment = $this->assignment;
        $data->dateTime = $this->dateTime;
        $data->userId = $this->userId;
        $data->save();


    }

}