<?php
namespace Nemundo\Process\App\Feed\Parameter;
use Nemundo\Web\Parameter\AbstractUrlParameter;
class FeedItemParameter extends AbstractUrlParameter {
protected function loadParameter() {
$this->parameterName = 'feeditem';
}
}