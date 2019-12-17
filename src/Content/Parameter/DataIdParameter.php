<?php


namespace Nemundo\Process\Content\Parameter;


use Nemundo\Web\Parameter\AbstractUrlParameter;

class DataIdParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName='data-id';
    }

}