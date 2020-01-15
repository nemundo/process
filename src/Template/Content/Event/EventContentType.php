<?php


namespace Nemundo\Process\Template\Content\Event;


use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Process\App\Calendar\Type\AbstractCalendarContentType;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\MenuTrait;
use Nemundo\Process\Template\Data\Event\Event;
use Nemundo\Process\Template\Data\Event\EventDelete;
use Nemundo\Process\Template\Data\Event\EventReader;
use Nemundo\Process\Template\Data\Event\EventUpdate;
use Nemundo\Process\Template\Type\FileContentType;
use Nemundo\Process\Template\Type\LargeTextContentType;
use Nemundo\User\Access\UserRestrictionTrait;

class EventContentType extends AbstractCalendarContentType
{

    /**
     * @var Date
     */
    public $date;

    public $event;

    use MenuTrait;
    use UserRestrictionTrait;

    protected function loadContentType()
    {
        // TODO: Implement loadContentType() method.
        $this->typeLabel='Event';
        $this->typeId = '6af8dd00-7aa7-4dd4-8906-9d00abcbfe7c';
        $this->viewClass=EventContentView::class;
        $this->formClass=EventContentForm::class;
        //$this->itemClass=EventContentItem::class;
        $this->listClass=EventContentList::class;


        // comment
        // image
        //

        $this->addMenuClass(LargeTextContentType::class);
        //$this->addMenuClass(FileContentType::class);


        $this->date = new Date();

    }


    protected function onCreate()
    {
        $data = new Event();
        //$data->id=$this->dataId;
        $data->date=$this->date;
        $data->event=$this->event;
        $this->dataId= $data->save();

    }

    protected function onUpdate()
    {
        $update = new EventUpdate();
        $update->date=$this->date;
        $update->event=$this->event;
        $update->updateById($this->dataId);
    }


    protected function onDelete()
    {
        (new EventDelete())->deleteById($this->dataId);
    }

   protected function getTitle()
    {
        return $this->getDataRow()->event;
    }

    protected function getDate()
    {
        // TODO: Implement getDate() method.
        return $this->getDataRow()->date;
    }


    public function getSubject()
    {

        $subject= $this->getDate()->getShortDateLeadingZeroFormat().' '.$this->getTitle();
        return $subject;

    }



    public function getDataRow()
    {

        $eventRow=(new EventReader())->getRowById($this->dataId);
       return $eventRow;

    }


}