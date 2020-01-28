<?php

namespace Nemundo\Process\Com\TrafficLight;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Core\Type\DateTime\Date;

class DateTrafficLight extends AbstractHtmlContainer
{

    /**
     * @var Date
     */
    public $date;

    public function getContent()
    {

        //$circle = new ColorCircle($this);

        if ($this->date !== null) {

            $circle = new TrafficLight($this);
            if ($this->date < ((new Date())->setNow())) {
                $circle->color = TrafficLightColor::RED;  // '#FF0000';
            }
        }

        return parent::getContent();
    }


}