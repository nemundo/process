<?php

namespace Nemundo\Process\Com\TrafficLight;


class YesNoTrafficLight extends AbstractTrafficLight
{

    /**
     * @var bool
     */
    public $value = false;

    public function getContent()
    {

        if ($this->value) {
            $this->color = TrafficLightColor::GREEN;
        } else {
            $this->color = TrafficLightColor::RED;
        }

        return parent::getContent();

    }

}