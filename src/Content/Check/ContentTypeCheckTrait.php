<?php


namespace Nemundo\Process\Content\Check;


use Nemundo\Core\Log\LogMessage;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Collection\AbstractContentTypeCollection;

trait ContentTypeCheckTrait
{


    // checkContentType
    public $contentTypeCheck=true;


    /**
     * @var AbstractContentType[]
     */
    private $allowedContentTypeList = [];


    public function addAllowedContentType(AbstractContentType $contentType)
    {

        $this->allowedContentTypeList[] = $contentType;
        return $this;

    }


    public function addAllowedContentTypeCollection(AbstractContentTypeCollection $contentTypeCollection) {

        foreach ($contentTypeCollection->getContentTypeList() as $contentType) {
            $this->addAllowedContentType($contentType);
        }

        return $this;

    }


    public function checkContentType(AbstractContentType $contentType)
    {

        if ($this->contentTypeCheck) {

        $allowed = false;
        foreach ($this->allowedContentTypeList as $allowedContentType) {

            if ($allowedContentType->typeId == $contentType->typeId) {
                $allowed = true;
            }

        }

        if (!$allowed) {
            (new LogMessage())->writeError('Content Type is not allowed');
            exit;
        }

        }


    }


}