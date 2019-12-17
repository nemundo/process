<?php


namespace Nemundo\Process\View;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\AbstractContentType;
use Nemundo\Process\Status\AbstractStatus;

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

}