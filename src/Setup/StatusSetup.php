<?php


namespace Nemundo\Process\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\AbstractContentType;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Data\Status\Status;
use Nemundo\Process\Status\AbstractStatus;
use Nemundo\Process\Status\ProcessStatusTrait;

class StatusSetup extends AbstractBase
{

    //

    public function addStatus(AbstractContentType $status) {

        $setup = new ContentTypeSetup();
        $setup->addContentType($status);

        $data = new Status();
        $data->updateOnDuplicate = true;
        //$data->id = $status->id;
        $data->statusLabel = $status->label;
        $data->contentTypeId = $status->id;
        //$data->statusClass = $status->getClassName();
        $data->save();



    }

}