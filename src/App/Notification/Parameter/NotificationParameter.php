<?php


namespace Nemundo\Process\App\Notification\Parameter;


use Nemundo\Web\Parameter\AbstractUrlParameter;

class NotificationParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName='notification';
    }

}