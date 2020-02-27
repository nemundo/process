<?php
namespace Nemundo\Process\App\Task\Parameter;
use Nemundo\Web\Parameter\AbstractUrlParameter;
class TaskTypeParameter extends AbstractUrlParameter {
protected function loadParameter() {
$this->parameterName = 'tasktype';
}
}