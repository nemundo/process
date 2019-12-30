<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Html\Container\AbstractHtmlContainer;

abstract class AbstractSequenceContentType extends AbstractContentType
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