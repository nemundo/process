<?php


namespace Nemundo\Process\Content\Parameter;


use Nemundo\Web\Parameter\AbstractUrlParameter;

class ContentParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName='content';
    }

}