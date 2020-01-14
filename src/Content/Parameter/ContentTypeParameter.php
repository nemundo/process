<?php


namespace Nemundo\Process\Content\Parameter;


use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class ContentTypeParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName = 'content-type';
    }


    public function getContentType($dataId = null)
    {

        $contentType = (new ContentTypeReader())->getRowById($this->getValue())->getContentType($dataId);
        return $contentType;

    }

}