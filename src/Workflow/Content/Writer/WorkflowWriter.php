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

        $processId = $this->contentType->contentId;

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


        //$stausId = $this->contentType->startContentType->contentId;

        $data = new Workflow();
        $data->id = $this->dataId;
        $data->processId = $processId;
        $data->number = $this->number;
        $data->workflowNumber = $this->workflowNumber;
        $data->statusId = $this->contentType->startContentType->contentId;  //$stausId;
        $data->subject = $this->workflowSubject;
        $data->assignment = $this->assignment;
        $data->dateTime = $this->dateTime;
        $data->userId = $this->userId;
        $data->save();

        //$type = clone( $this->contentType->startContentType);
        //$type->saveType();

        //$this->contentType->startContentType->parentId = $this->dataId;
        //$this->contentType->startContentType->saveType();


        //if ($this->parentId !==null) {
        /*$writer = new TreeContentWriter();
        $writer->parentId = $this->dataId;
        $writer->dataId = null;  //  $this->contentType->startContentType->getDataId();
        $writer->contentType = $this->contentType->startContentType;
        $writer->dateTime = $this->dateTime;
        $writer->userId = $this->userId;
        $writer->write();*/
        //}

    }

}