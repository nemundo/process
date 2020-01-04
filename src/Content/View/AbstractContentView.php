<?php


namespace Nemundo\Process\Content\View;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Type\AbstractContentType;

abstract class AbstractContentView extends AbstractHtmlContainer
{

    /**
     * @var AbstractContentType
     */
    //public $contentType;

    /**
     * @var string
     */
    public $dataId;


}