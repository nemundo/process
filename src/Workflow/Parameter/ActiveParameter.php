<?php


namespace Nemundo\Process\Workflow\Parameter;


use Nemundo\Web\Parameter\AbstractUrlParameter;

class ActiveParameter extends AbstractUrlParameter
{
    protected function loadParameter()
    {
        $this->parameterName = 'active';
        $this->defaultValue = 1;
        // TODO: Implement loadParameter() method.
    }
}