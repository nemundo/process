<?php


namespace Nemundo\Process\App\Notification\Parameter;


use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Process\App\Notification\Data\Notification\NotificationUpdate;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class SourceParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName='source';
    }






}