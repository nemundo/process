<?php
namespace Nemundo\Process\App\News\Parameter;
use Nemundo\Web\Parameter\AbstractUrlParameter;
class NewsParameter extends AbstractUrlParameter {
protected function loadParameter() {
$this->parameterName = 'news';
}
}