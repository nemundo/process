<?php


namespace Nemundo\Process\Parameter;


use Nemundo\Process\Data\Status\StatusReader;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class StatusParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName = 'status1';
    }


    public function getStatus()
    {

        $status = null;
        if ($this->existsParameter()) {

            $statusReader = new StatusReader();
            $statusReader->model->loadContentType();
            $statusReader->filter->andEqual($statusReader->model->contentTypeId, $this->getValue());
            //$statusRow = $statusReader->getRowById($this->getValue());
            $statusRow=$statusReader->getRow();
            $status = $statusRow->getStatus();
        }

        return $status;

    }

}