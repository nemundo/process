<?php


namespace Nemundo\Process\Content\Parameter;


use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class SequenceContentTypeParameter extends ContentTypeParameter
{

    protected function loadParameter()
    {
        $this->parameterName = 'sequence-content-type';
    }



}