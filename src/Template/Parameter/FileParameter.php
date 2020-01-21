<?php


namespace Nemundo\Process\Template\Parameter;


use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class FileParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName = 'file';
    }

    public function getContentType() {

        $type = new FileContentType($this->getValue());

        return $type;

    }


}