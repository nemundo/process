<?php


namespace Nemundo\Process\App\Calendar\Type;


use Nemundo\Process\App\Calendar\Data\CalendarIndex\CalendarIndex;

trait CalendarIndexTrait
{


    public $date;

    public $title;


    abstract protected function getDate();


    protected function saveCalendarIndex()
    {

        $data = new CalendarIndex();
        $data->updateOnDuplicate = true;
        $data->contentId = $this->getContentId();
        $data->date = $this->getDate();
        $data->title = $this->getSubject();  //getTitle();
        $data->save();

    }


    protected function deleteCalendarIndex()
    {


    }


}