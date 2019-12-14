<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Data\Workflow\Workflow;
use Nemundo\Process\Data\Workflow\WorkflowValue;
use Nemundo\Process\Process\AbstractProcess;
use Nemundo\User\Type\UserSessionType;
use Nemundo\Workflow\App\Identification\Model\Identification;


// ProcessBuilder
abstract class AbstractWorkflowBuilder extends AbstractBase
{

    /**
     * @var AbstractProcess
     */
    protected $process;

    /**
     * @var string
     */
    public $workflowId;

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

    protected function loadWorkflow() {

    }

    abstract public function createWorkflow();

    public function __construct()
    {

        $this->assignment = new Identification();
        $this->dateTime = (new DateTime())->setNow();
        $this->userId = (new UserSessionType())->userId;


        $this->loadWorkflow();

    }

    protected function saveWorkflow()
    {

        if ($this->number == null) {
            $value = new WorkflowValue();
            $value->field = $value->model->number;
            $value->filter->andEqual($value->model->processId, $this->process->id);
            $this->number = $value->getMaxValue();
            if ($this->number == "") {
                $this->number = $this->process->startNumber;
            }
            $this->number = $this->number + 1;

            $this->workflowNumber = $this->process->prefixNumber . $this->number;
        }


        $data = new Workflow();
        $data->processId = $this->process->id;
        $data->number = $this->number;
        $data->workflowNumber = $this->workflowNumber;
        $data->statusId = $this->process->startStatus->id;
        $data->subject = $this->subject;
        $data->assignment = $this->assignment;
        $data->dateTime = $this->dateTime;
        $data->userId = $this->userId;
        $this->workflowId = $data->save();


        $builder =new DateTimeUserIdStatusLogBuilder($this->workflowId);
        $builder->status = $this->process->startStatus;
        $builder->dateTime=$this->dateTime;
        $builder->userId = $this->userId;
        $builder->saveStatus();


    }


}