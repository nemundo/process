<?php
namespace Nemundo\Process\App\Dashboard\Parameter;
use Nemundo\Web\Parameter\AbstractUrlParameter;
class DashboardParameter extends AbstractUrlParameter {
protected function loadParameter() {
$this->parameterName = 'dashboard';
}
}