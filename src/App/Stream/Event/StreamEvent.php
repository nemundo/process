<?php


namespace Nemundo\Process\App\Stream\Event;


use Nemundo\Process\App\Stream\Data\Stream\Stream;
use Nemundo\Process\Content\Event\AbstractContentEvent;
use Nemundo\Process\Content\Type\AbstractType;

class StreamEvent extends AbstractContentEvent
{

    public function onCreate(AbstractType $contentType)
    {

        $data=new Stream();
        $data->contentId=$contentType->getContentId();
        $data->save();

    }

}