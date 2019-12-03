<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Data\Workflow\Workflow;
use Nemundo\Process\Data\Workflow\WorkflowValue;
use Nemundo\Process\Process\AbstractProcess;

abstract class AbstractWorkflowBuilder extends AbstractBase
{

    /**
     * @var AbstractProcess
     */
    protected $process;

    protected $workflowId;

    abstract protected function loadWorkflow();

    abstract public function createWorkflow();

    public function __construct()
    {
        $this->loadWorkflow();
    }

    protected function saveWorkflow($subject='[no subject]') {

        $value = new WorkflowValue();
        $value->field = $value->model->number;
        $value->filter->andEqual($value->model->processId,$this->process->id );
        $nr = $value->getMaxValue();
        if ($nr == "") {
            $nr =$this->process->startNumber;
        }
        $nr = $nr + 1;

        $data = new Workflow();
        $data->processId = $this->process->id;
        $data->number = $nr;
        $data->workflowNumber =$this->process->prefixNumber . $nr;
        $data->statusId = $this->process->startStatus->id;
        $data->subject = $subject;  // '[no subject]';  // $this->betreff;
           //$data->verantwortlicher = $verantwortlicher;
        $this->workflowId = $data->save();



        $workflowBuilder = new WorkflowLogBuilder();
        $workflowBuilder->workflowId=$this->workflowId;
        $workflowBuilder->status= $this->process->startStatus;
         $workflowBuilder->saveLog();



    }


}