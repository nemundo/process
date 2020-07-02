<?php


namespace Nemundo\Process\Cms\Event;


use Nemundo\Process\Cms\Data\Cms\Cms;
use Nemundo\Process\Content\Event\AbstractContentEvent;
use Nemundo\Process\Content\Type\AbstractType;

class CmsEvent extends AbstractContentEvent
{

    public function onCreate(AbstractType $contentType)
    {

        $data = new Cms();
        $data->parentId = $contentType->getParentId();
        $data->contentId = $contentType->getContentId();
        $data->itemOrder = 0;
        $data->save();



    }

}