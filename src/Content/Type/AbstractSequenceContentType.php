<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Item\AbstractTreeContentType;

abstract class AbstractSequenceContentType extends AbstractTreeContentType
{

    /**
     * @var AbstractMenuContentType
     */
    public $startContentType;


    /*
    public function getForm(AbstractHtmlContainer $parent)
    {

        $form = $this->startContentType->getForm($parent);
        return $form;

    }*/


}