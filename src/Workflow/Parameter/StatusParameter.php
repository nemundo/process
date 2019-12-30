<?php


namespace Nemundo\Process\Workflow\Parameter;


use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Workflow\Data\Status\StatusReader;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class StatusParameter extends ContentTypeParameter  // AbstractContentTypePar  // AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName = 'status1';
    }


    public function getStatus()
    {

        $status = null;
        if ($this->existsParameter()) {

        $status = $this->getContentType();
        /*

            $statusReader = new StatusReader();
            $statusReader->model->loadContentType();
            $statusReader->filter->andEqual($statusReader->model->contentTypeId, $this->getValue());
            //$statusRow = $statusReader->getRowById($this->getValue());
            $statusRow=$statusReader->getRow();
            $status = $statusRow->getStatus();*/
        }

        return $status;

    }

}