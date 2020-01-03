<?php


namespace Nemundo\Process\Workflow\Content\Writer;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\Writer\TreeContentWriter;
use Nemundo\Process\Workflow\Content\Item\Status\DateTimeUserIdStatusItem;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Data\Workflow\Workflow;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowValue;

class WorkflowWriter extends TreeContentWriter  // TreeContentWriter  // ContentWriter  // AbstractBase
{

    /**
     * @var AbstractProcess
     */
    public $contentType;


    public $number;

    public $workflowNumber;


    public function write() {


        parent::write();

        $processId = $this->contentType->contentId;

        if ($this->number == null) {
            $value = new WorkflowValue();
            $value->field = $value->model->number;
            $value->filter->andEqual($value->model->processId, $processId);
            $this->number = $value->getMaxValue();
            if ($this->number == "") {
                $this->number = $this->contentType->startNumber;
            }
            $this->number = $this->number + 1;

            $this->workflowNumber = $this->contentType->prefixNumber . $this->number;
        }


        $stausId = $this->contentType->startContentType->contentId;

        $data = new Workflow();
        $data->id = $this->dataId;
        $data->processId = $processId;
        $data->number = $this->number;
        $data->workflowNumber = $this->workflowNumber;
        $data->statusId = $stausId;
        $data->subject = $this->subject;
        //$data->assignment = $this->assignment;
        $data->dateTime = $this->dateTime;
        $data->userId = $this->userId;
        $data->save();

        $writer=new TreeContentWriter();
        $writer->parentId = $this->dataId;
        $writer->contentType = $this->contentType->startContentType;
        $writer->dateTime = $this->dateTime;
        $writer->userId = $this->userId;
$writer->write();

    }

}