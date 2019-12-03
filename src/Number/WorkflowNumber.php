<?php


namespace Nemundo\Process\Number;


use Nemundo\Core\Base\AbstractBase;
use Schleuniger\App\ChangeRequest\Data\Ecr\EcrReader;
use Schleuniger\App\ChangeRequest\Data\Workflow\WorkflowValue;
use Nemundo\Process\Process\AbstractProcess;

class WorkflowNumber extends AbstractBase
{


    public function getEcrId($workflowId) {

        $ecrReader = new EcrReader();
        $ecrReader->model->loadWorkflow();
        $ecrReader->filter->andEqual($ecrReader->model->workflowId,$workflowId);
        $ecrRow = $ecrReader->getRow();
        $workflowId = $ecrRow->workflowId;

        return $workflowId;

    }





    public function getWorkflowNumber(AbstractProcess $process) {

        $value = new WorkflowValue();
        $value->field = $value->model->nr;
        $value->filter->andEqual($value->model->processId,$process->id );
        $nr = $value->getMaxValue();
        if ($nr == "") {
            $nr =$process->startNumber;  // 999;
        }
        $nr = $nr + 1;

        return $nr;

    }

}