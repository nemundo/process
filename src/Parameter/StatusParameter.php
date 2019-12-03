<?php


namespace Nemundo\Process\Parameter;


use Nemundo\Process\Data\Status\StatusReader;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class StatusParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName='status';
        // TODO: Implement loadParameter() method.
    }


    public function getStatus()
    {

        $status = null;
        if ($this->existsParameter()) {
            $statusRow = (new StatusReader())->getRowById($this->getValue());
            $status = $statusRow->getStatus();
        }

        return $status;

    }

}