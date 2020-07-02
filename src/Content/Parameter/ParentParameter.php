<?php


namespace Nemundo\Process\Content\Parameter;


class ParentParameter extends AbstractContentUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName = 'parent';
    }

}