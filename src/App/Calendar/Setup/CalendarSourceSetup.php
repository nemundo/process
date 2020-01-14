<?php


namespace Nemundo\Process\App\Calendar\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\App\Calendar\Data\CalendarSourceType\CalendarSourceType;
use Nemundo\Process\Content\Type\AbstractContentType;

class CalendarSourceSetup extends AbstractBase
{

    public function addSourceContentType(AbstractContentType $contentType) {

        $data = new CalendarSourceType();
        $data->ignoreIfExists=true;
        $data->contentTypeId=$contentType->typeId;
        $data->save();

        return $this;

    }

}