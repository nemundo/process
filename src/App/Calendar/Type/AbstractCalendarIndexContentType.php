<?php


namespace Nemundo\Process\App\Calendar\Type;


use Nemundo\Process\App\Calendar\Data\CalendarIndex\CalendarIndex;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

abstract class AbstractCalendarIndexContentType extends AbstractTreeContentType
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
        $data->contentId=$this->dataId;
        $data->date = $this->getDate();
        $data->title= $this->getTitle();
        $data->save();

        return $this->dataId;

    }

}