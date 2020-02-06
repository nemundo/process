<?php


namespace Nemundo\Process\Content\Parameter;


use Nemundo\Core\Log\LogMessage;
use Nemundo\Process\Content\Check\ContentTypeCheckTrait;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class ContentTypeParameter extends AbstractUrlParameter
{

    use ContentTypeCheckTrait;

    /**
     * @var AbstractContentType[]
     */
    //private $allowedContentTypeList=[];

    protected function loadParameter()
    {
        $this->parameterName = 'content-type';
    }


/*
    public function addAllowedContentType(AbstractContentType $contentType) {

        $this->allowedContentTypeList[]=$contentType;
        return $this;

    }*/


    public function getContentType($dataId = null)
    {

        $contentType = (new ContentTypeReader())->getRowById($this->getValue())->getContentType($dataId);
        $this->checkContentType($contentType);

        return $contentType;

    }

}