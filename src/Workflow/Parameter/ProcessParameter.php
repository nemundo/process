<?php


namespace Nemundo\Process\Workflow\Parameter;


use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class ProcessParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName = 'process';
        // TODO: Implement loadParameter() method.
    }


    public function getProcess()
    {

        /** @var AbstractProcess $contentType */
        $contentType = (new ContentTypeReader())->getRowById($this->getValue())->getContentType();

        return $contentType;


    }

}