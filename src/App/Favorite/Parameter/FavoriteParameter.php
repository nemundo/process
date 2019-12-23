<?php

namespace Nemundo\Process\App\Favorite\Parameter;

use Nemundo\Web\Parameter\AbstractUrlParameter;

class FavoriteParameter extends AbstractUrlParameter
{
    protected function loadParameter()
    {
        $this->parameterName = 'favorite';
    }
}