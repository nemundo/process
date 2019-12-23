<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Base\AbstractBase;

abstract class AbstractContentTypeCollection extends AbstractBase
{

    abstract protected function loadCollection();

    /**
     * @var AbstractContentType[]
     */
    private $contentTypeList=[];

    public function __construct()
    {
        $this->loadCollection();
    }


    protected function addContentType(AbstractContentType $contentType) {
        $this->contentTypeList[]=$contentType;
        return $this;
    }

    public function getContentTypeList() {
        return $this->contentTypeList;
    }
}