<?php


namespace Nemundo\Process\App\Message\Parameter;


use Nemundo\Web\Parameter\AbstractUrlParameter;

class MessageParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName='message';
        // TODO: Implement loadParameter() method.
    }

}