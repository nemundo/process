<?php


namespace Nemundo\Process\App\Calendar\Type;


use Nemundo\Process\App\Calendar\Data\CalendarIndex\CalendarIndex;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

// AbstractCalendarContentType
abstract class AbstractCalendarContentType extends AbstractTreeContentType
{

    abstract protected function getDate();
    abstract protected function getTitle();

    public function getPlace() {
        $place='';
        return $place;
    }


    public function saveType()
    {

        parent::saveType();

        $data=new CalendarIndex();
        $data->updateOnDuplicate=true;
        $data->contentId=$this->getContentId();
        $data->date = $this->getDate();
        $data->title= $this->getTitle();
        $data->save();

    }

}