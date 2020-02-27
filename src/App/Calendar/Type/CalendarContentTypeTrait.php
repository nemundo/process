<?php


namespace Nemundo\Process\App\Calendar\Type;


use Nemundo\Process\App\Calendar\Data\CalendarIndex\CalendarIndex;

trait CalendarContentTypeTrait
{


    public $date;

    public $title;

protected function saveCalendar()
    {

        $data=new CalendarIndex();
        $data->updateOnDuplicate=true;
        $data->contentId=$this->getContentId();
        $data->date = $this->getDate();
        $data->title= $this->getTitle();
        $data->save();

    }



}