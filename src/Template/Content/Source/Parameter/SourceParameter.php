<?php


namespace Nemundo\Process\Template\Content\Source\Parameter;


use Nemundo\Web\Parameter\AbstractUrlParameter;

class SourceParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName = 'template-source';
    }

}