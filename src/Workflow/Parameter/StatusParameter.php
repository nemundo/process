<?php


namespace Nemundo\Process\Workflow\Parameter;


use Nemundo\Process\Content\Parameter\ContentTypeParameter;

class StatusParameter extends ContentTypeParameter
{

    protected function loadParameter()
    {
        $this->parameterName = 'status';
    }


    public function getStatus()
    {

        $status = null;
        if ($this->existsParameter()) {
            $status = $this->getContentType();
        }

        return $status;

    }

}