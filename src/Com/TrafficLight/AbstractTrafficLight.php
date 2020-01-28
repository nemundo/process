<?php

namespace Nemundo\Process\Com\TrafficLight;


use Nemundo\Html\Container\AbstractHtmlContainer;

abstract class AbstractTrafficLight extends AbstractHtmlContainer
{

    /**
     * @var int
     */
    protected $size = 20;

    /**
     * @var string
     */
    protected $color = TrafficLightColor::WHITE;

    public function getContent()
    {
        $this->tagName = 'div';
        $style = 'background: ' . $this->color . ';border-radius: 50%;width: ' . $this->size . 'px;height: ' . $this->size . 'px; border-style: solid;border; border-width: 1px;';
        $this->addAttribute('style', $style);
        return parent::getContent();
    }


}