<?php


namespace Nemundo\Process\Content\Parameter;


use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class ContentParameter extends AbstractContentUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName = 'content';
    }

}