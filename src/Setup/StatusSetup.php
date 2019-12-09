<?php


namespace Nemundo\Process\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Data\Status\Status;
use Nemundo\Process\Status\AbstractStatus;

class StatusSetup extends AbstractBase
{

    public function addStatus(AbstractStatus $status) {

        $data = new Status();
        $data->updateOnDuplicate = true;
        $data->id = $status->id;
        $data->statusLabel = $status->label;
        $data->statusClass = $status->getClassName();
        $data->save();



    }

}