<?php


namespace Nemundo\Process\Content\Parameter;


use Nemundo\Process\Content\Check\ContentTypeCheckTrait;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class ContentTypeParameter extends AbstractUrlParameter
{

    use ContentTypeCheckTrait;


    protected function loadParameter()
    {
        $this->parameterName = 'content-type';
    }


    public function getContentType($dataId = null)
    {

        $contentType = (new ContentTypeReader())->getRowById($this->getValue())->getContentType($dataId);
        $this->checkContentType($contentType);

        return $contentType;

    }

}