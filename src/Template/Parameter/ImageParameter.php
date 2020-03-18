<?php


namespace Nemundo\Process\Template\Parameter;


use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Content\Image\ImageContentType;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class ImageParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName = 'image';
    }

    public function getContentType() {

        $type = new ImageContentType($this->getValue());
        return $type;

    }


}