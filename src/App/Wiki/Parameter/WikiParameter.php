<?php

namespace Nemundo\Process\App\Wiki\Parameter;

use Nemundo\Web\Parameter\AbstractUrlParameter;

class WikiParameter extends AbstractUrlParameter
{
    protected function loadParameter()
    {
        $this->parameterName = 'wiki';
    }
}