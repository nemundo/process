<?php


namespace Nemundo\Process\Content\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\AbstractContentType;
use Nemundo\Process\Content\Data\ContentType\ContentType;

class ContentTypeSetup extends AbstractBase
{

    public function addContentType(AbstractContentType $contentType) {

        $data = new ContentType();
        $data->updateOnDuplicate=true;
        $data->id=$contentType->id;
        $data->phpClass=$contentType->getClassName();
        $data->save();

    }

}