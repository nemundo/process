<?php


namespace Nemundo\Process\Template\Content\Event;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Template\Data\Event\EventDelete;
use Nemundo\Process\Template\Data\Event\EventReader;

class EventContentDelete extends AbstractBase
{

    public function delete() {

        $reader = new EventReader();
        foreach ($reader->getData() as $eventRow) {
            $item=new EventContentItem($eventRow->id);
            $item->deleteItem();
        }

        (new EventDelete())->delete();

    }


}