<?php


namespace Nemundo\Process\Content\Com\Container;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class AbstractParentContainer extends AbstractHtmlContainer
{

    /**
     * @var string
     */
    public $parentId;

    /**
     * @var AbstractTreeContentType
     */
    public $contentType;


}