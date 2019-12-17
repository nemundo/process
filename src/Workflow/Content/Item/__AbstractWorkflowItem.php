<?php


namespace Nemundo\Process\Item;


use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Builder\DateTimeUserIdStatusLogBuilder;

use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\User\Type\UserSessionType;
use Nemundo\Workflow\App\Identification\Model\Identification;


// ProcessBuilder
abstract class AbstractWorkflowItemOld extends AbstractContentItem
{

    /**
     * @var AbstractProcess
     */
    public $contentType;

    /**
     * @var string
     */
    public $dataId;

    protected $subject = '[no subject]';

    /**
     * @var Identification
     */
    protected $assignment;

    /**
     * @var int
     */
    protected $number;

    /**
     * @var string
     */
    protected $workflowNumber;

    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * @var string
     */
    protected $userId;

    protected function loadWorkflow()
    {

    }

    //abstract public function createWorkflow();


    /*
    public function __construct($id = null)
    {
        parent::__construct($id);


        $this->assignment = new Identification();
        $this->dateTime = (new DateTime())->setNow();
        $this->userId = (new UserSessionType())->userId;


        $this->loadWorkflow();

    }*/


    protected function saveWorkflow()
    {

        $id = new ProcessId();
        $id->filter->andEqual($id->model->contentTypeId, $this->contentType->id);
        $processId = $id->getId();


        if ($this->number == null) {
            $value = new WorkflowValue();
            $value->field = $value->model->number;
            $value->filter->andEqual($value->model->processId, $processId);  // $this->process->id);
            $this->number = $value->getMaxValue();
            if ($this->number == "") {
                $this->number = $this->contentType->startNumber;
            }
            $this->number = $this->number + 1;

            $this->workflowNumber = $this->contentType->prefixNumber . $this->number;
        }


        //(new Debug())->write('process');
        //(new Debug())->write('start id '.$this->process->startStatus->id);

        $id = new StatusId();
        $id->filter->andEqual($id->model->contentTypeId, $this->contentType->startStatus->id);
        $stausId = $id->getId();


        $data = new Workflow();
        $data->processId = $processId;  // $this->process->id;
        $data->number = $this->number;
        $data->workflowNumber = $this->workflowNumber;
        $data->statusId = $stausId;  // $this->process->startStatus->id;
        $data->subject = $this->subject;
        $data->assignment = $this->assignment;
        $data->dateTime = $this->dateTime;
        $data->userId = $this->userId;
        $this->dataId = $data->save();


        $this->saveContent();

        /*
        $data = new Content();
        $data->contentTypeId = $this->contentType->id;
        $data->dataId = $this->dataId;
        $data->dateTimeCreated = $this->dateTime;
        $data->userCreatedId = $this->userId;
        $data->save();*/


        $builder = new DateTimeUserIdStatusLogBuilder();  // StatusItem new DateTimeUserIdStatusLogBuilder();  //$this->workflowId);
        $builder->parentId = $this->dataId;
        $builder->contentType = $this->contentType->startStatus;
        $builder->dateTime = $this->dateTime;
        $builder->userId = $this->userId;
        $builder->saveItem();


    }


}