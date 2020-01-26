<?php

namespace Nemundo\Process\Group\Parameter;

use Nemundo\Web\Parameter\AbstractUrlParameter;

class GroupTypeParameter extends AbstractUrlParameter
{
    protected function loadParameter()
    {
        $this->parameterName = 'group-type';
    }
}