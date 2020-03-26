<?php


namespace Nemundo\Process\Content\View;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

abstract class AbstractContentView extends AbstractHtmlContainer
{

    /**
     * @var AbstractContentType|AbstractTreeContentType
     */
    public $contentType;

}