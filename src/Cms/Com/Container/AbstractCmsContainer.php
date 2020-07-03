<?php


namespace Nemundo\Process\Cms\Com\Container;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Type\AbstractContentType;

class AbstractCmsContainer extends AbstractHtmlContainer
{

    /**
     * @var AbstractContentType
     */
    public $contentType;

}