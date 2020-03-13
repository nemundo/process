<?php


namespace Nemundo\Process\App\Notification\Parameter;


use Nemundo\Web\Parameter\AbstractUrlParameter;

// Status
class ArchiveParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName='archive';
    }

}