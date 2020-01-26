<?php

namespace Nemundo\Process\App\Assignment\Parameter;

use Nemundo\Web\Parameter\AbstractUrlParameter;

class SourceParameter extends AbstractUrlParameter
{
    protected function loadParameter()
    {
        $this->parameterName = 'source';
    }
}