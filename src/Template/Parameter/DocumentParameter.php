<?php


namespace Nemundo\Process\Template\Parameter;


use Nemundo\Web\Parameter\AbstractUrlParameter;

class DocumentParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
  $this->parameterName='document';
    }

}