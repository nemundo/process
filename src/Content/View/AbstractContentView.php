<?php


namespace Nemundo\Process\Content\View;


use Nemundo\Core\Debug\Debug;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\App\WebLog\Content\WebLogContentType;
use Nemundo\Process\Content\Type\AbstractContentType;

abstract class AbstractContentView extends AbstractHtmlContainer
{

    /**
     * @var AbstractContentType
     */
    public $contentType;

    /**
     * @var string
     */
    public $dataId;


    public function getContent()
    {

        $log=new WebLogContentType();
        $log->parentId=$this->contentType->getContentId();
        $log->saveType();

        return parent::getContent();
    }


}