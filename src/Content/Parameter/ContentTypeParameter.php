<?php


namespace Nemundo\Process\Content\Parameter;


use Nemundo\Web\Parameter\AbstractUrlParameter;

class ContentTypeParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName='content-type';
    }

}