<?php

namespace Nemundo\Process\App\Feed\Parameter;

use Nemundo\Web\Parameter\AbstractUrlParameter;

class FeedParameter extends AbstractUrlParameter
{
    protected function loadParameter()
    {
        $this->parameterName = 'feed';
    }
}