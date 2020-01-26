<?php


namespace Nemundo\Process\App\Assignment\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\App\Assignment\Data\AssignmentSource\AssignmentSource;
use Nemundo\Process\Content\Type\AbstractContentType;

class AssignmentSetup extends AbstractBase
{

    public function addSource(AbstractContentType $contentType)
    {

        $data = new AssignmentSource();
        $data->ignoreIfExists = true;
        $data->sourceId = $contentType->typeId;
        $data->save();

        return $this;

    }

}