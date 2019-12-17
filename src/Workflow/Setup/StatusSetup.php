<?php


namespace Nemundo\Process\Workflow\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Workflow\Content\Status\AbstractStatus;
use Nemundo\Process\Workflow\Data\Status\Status;

class StatusSetup extends AbstractBase
{

    public function addStatus(AbstractStatus $status)
    {

        $setup = new ContentTypeSetup();
        $setup->addContentType($status);

        $data = new Status();
        $data->updateOnDuplicate = true;
        $data->statusLabel = $status->label;
        $data->contentTypeId = $status->id;
        $data->save();

    }

}