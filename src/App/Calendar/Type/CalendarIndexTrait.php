<?php


namespace Nemundo\Process\App\Calendar\Type;


use Nemundo\Process\App\Calendar\Data\CalendarIndex\CalendarIndex;
use Nemundo\Process\App\Calendar\Data\CalendarIndex\CalendarIndexDelete;

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

        $delete= new CalendarIndexDelete();
        $delete->filter->andEqual($delete->model->contentId,$this->getContentId());
        $delete->delete();

    }


}