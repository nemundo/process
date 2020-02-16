<?php


namespace Nemundo\Process\Content\Parameter;


use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Web\Parameter\AbstractUrlParameter;

// DataParameter
class DataIdParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName='data';
    }



}